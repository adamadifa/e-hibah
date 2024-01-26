<?php

namespace App\Http\Controllers;

use App\Models\Jenispengajuandana;
use App\Models\Penerimahibah;
use App\Models\Proposal;
use App\Models\Tahunanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class ProposalController extends Controller
{

    public function index(Request $request)
    {
        $query = Proposal::query();
        $query->select('proposal.*', 'penerimahibah.nama', 'jenis_pengajuan_dana', 'tahun');
        $query->join('penerimahibah', 'proposal.kode_penerimahibah', '=', 'penerimahibah.kode_penerimahibah');
        $query->join('jenis_pengajuan_dana', 'proposal.id_jenispengajuan_dana', '=', 'jenis_pengajuan_dana.id');
        $query->join('tahun_anggaran', 'proposal.kode_anggaran', '=', 'tahun_anggaran.kode_anggaran');
        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('tanggal_proposal', [$request->dari, $request->sampai]);
        }

        if (!empty($request->kode_anggaran)) {
            $query->where('proposal.kode_anggaran', $request->kode_anggaran);
        }

        if (!empty($request->nama)) {
            $query->where('penerimahibah.nama', 'like', '%' . $request->nama . '%');
        }
        $proposal = $query->paginate(30);

        $tahun_anggaran = Tahunanggaran::orderBy('tahun')->get();
        return view('proposal.index', compact('proposal', 'tahun_anggaran'));
    }
    public function create($kode_penerimahibah)
    {
        $kode_penerimahibah = Crypt::decrypt($kode_penerimahibah);
        $penerimahibah = Penerimahibah::where('kode_penerimahibah', $kode_penerimahibah)->first();
        $jenis_pengajuan_dana = Jenispengajuandana::orderBy('id')->get();
        $tahun_anggaran = Tahunanggaran::orderBy('tahun')->get();
        return view('proposal.create', compact('penerimahibah', 'jenis_pengajuan_dana', 'tahun_anggaran'));
    }


    public function store($kode_penerimahibah, Request $request)
    {
        $kode_penerimahibah = Crypt::decrypt($kode_penerimahibah);
        $penerimahibah = Penerimahibah::where('kode_penerimahibah', $kode_penerimahibah)->first();
        $request->validate([
            'tanggal_proposal' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|numeric',
            'email' => 'email',
            'penanggung_jawab' => 'required',
            'no_telepon_penanggung_jawab' => 'required|numeric',
            'email_penanggung_jawab' => 'email',
            'nama_bank' => 'required',
            'no_rekening' => 'required|numeric',
            'nama_pemilik_rekening' => 'required',
            'no_surat' => 'required',
            'tanggal_surat' => 'required',
            'id_jenispengajuan_dana' => 'required',
            'kode_anggaran' => 'required',
            'jumlah_dana' => 'required',
            'lampiran_surat' => 'required|mimes:pdf'

        ]);
        DB::beginTransaction();
        try {

            $lastproposal = Proposal::where('tanggal_proposal', $request->tanggal_proposal)
                ->orderBy('no_registrasi', 'desc')
                ->first();
            $last_no_registrasi = $lastproposal != null ? $lastproposal->no_registrasi : '';
            $format = "REG-" . date('Ymd', strtotime($request->tanggal_proposal));
            $no_registrasi = buatkode($last_no_registrasi, $format, 5);


            $data_ktp = [];
            $data_rekening = [];
            if ($request->hasfile('file_ktp')) {
                $ktp_name =  "KTP-" . $kode_penerimahibah . "." . $request->file('file_ktp')->getClientOriginalExtension();
                $destination_ktp_path = "/public/doc-penerimahibah";
                $ktp = $ktp_name;
                $data_ktp = [
                    'file_ktp' => $ktp
                ];
            }

            if ($request->hasfile('file_rekening')) {
                $rekening_name =  "RK-" . $kode_penerimahibah . "." . $request->file('file_rekening')->getClientOriginalExtension();
                $destination_rekening_path = "/public/doc-penerimahibah";
                $rekening = $rekening_name;
                $data_rekening = [
                    'file_rekening' => $rekening
                ];
            }

            if ($request->hasfile('lampiran_surat')) {
                $lampiran_surat_name = $no_registrasi . "." . $request->file('lampiran_surat')->getClientOriginalExtension();
                $destinatio_lampiransurat_path = "/public/lampiran-surat";
                $lampiransurat = $lampiran_surat_name;
                $data_lampiransurat = [
                    'lampiran_surat' => $lampiransurat
                ];
            }
            $data_penerimahibah = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'latitude' => $request->latitiude,
                'longitude' => $request->longitude,
                'no_izin' => $request->no_izin,
                'no_telepon' => $request->no_telepon,
                'email' => $request->email,
                'penanggung_jawab' => $request->penanggung_jawab,
                'no_telepon_penanggung_jawab' => $request->no_telepon_penanggung_jawab,
                'email_penanggung_jawab' => $request->email_penanggung_jawab,
                'nama_bank' => $request->nama_bank,
                'no_rekening' => $request->no_rekening,
                'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
            ];


            $data = array_merge($data_penerimahibah, $data_ktp, $data_rekening);


            $update = Penerimahibah::where('kode_penerimahibah', $kode_penerimahibah)
                ->update($data);

            if ($update) {
                if ($request->hasfile('file_ktp')) {
                    Storage::delete($destination_ktp_path . "/" . $penerimahibah->file_ktp);
                    $request->file('file_ktp')->storeAs($destination_ktp_path, $ktp_name);
                }

                if ($request->hasfile('file_rekening')) {
                    Storage::delete($destination_ktp_path . "/" . $penerimahibah->file_rekening);
                    $request->file('file_rekening')->storeAs($destination_rekening_path, $rekening_name);
                }
            }

            $data_prop  = [
                'no_registrasi' => $no_registrasi,
                'tanggal_proposal' => $request->tanggal_proposal,
                'kode_penerimahibah' => $kode_penerimahibah,
                'no_surat' => $request->no_surat,
                'tanggal_surat' => $request->tanggal_surat,
                'id_jenispengajuan_dana' => $request->id_jenispengajuan_dana,
                'kode_anggaran' => $request->kode_anggaran,
                'jumlah_dana' => toNumber($request->jumlah_dana),
                'judul_proposal' => $request->judul_proposal,
                'id_jenis_proposal' => 1
            ];

            $data_proposal = array_merge($data_prop, $data_lampiransurat);
            $simpanproposal = Proposal::create($data_proposal);
            if ($simpanproposal) {
                if ($request->hasfile('lampiran_surat')) {
                    $request->file('lampiran_surat')->storeAs($destinatio_lampiransurat_path, $lampiran_surat_name);
                }
            }
            DB::commit();
            return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan']);
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with(['error' => 'Data Gagal Di Simpan']);
        }
    }

    public function edit($no_registrasi)
    {
        $no_registrasi = Crypt::decrypt($no_registrasi);
        $proposal = Proposal::where('no_registrasi', $no_registrasi)->first();
        $penerimahibah = Penerimahibah::where('kode_penerimahibah', $proposal->kode_penerimahibah)->first();
        $jenis_pengajuan_dana = Jenispengajuandana::orderBy('id')->get();
        $tahun_anggaran = Tahunanggaran::orderBy('tahun')->get();
        return view('proposal.edit', compact('penerimahibah', 'jenis_pengajuan_dana', 'tahun_anggaran', 'proposal'));
    }

    public function update($no_registrasi, Request $request)
    {
        $no_registrasi = Crypt::decrypt($no_registrasi);
        $proposal = Proposal::where('no_registrasi', $no_registrasi)->first();
        $kode_penerimahibah = $proposal->kode_penerimahibah;
        $penerimahibah = Penerimahibah::where('kode_penerimahibah', $proposal->kode_penerimahibah)->first();
        $request->validate([
            'tanggal_proposal' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|numeric',
            'email' => 'email',
            'penanggung_jawab' => 'required',
            'no_telepon_penanggung_jawab' => 'required|numeric',
            'email_penanggung_jawab' => 'email',
            'nama_bank' => 'required',
            'no_rekening' => 'required|numeric',
            'nama_pemilik_rekening' => 'required',
            'no_surat' => 'required',
            'tanggal_surat' => 'required',
            'id_jenispengajuan_dana' => 'required',
            'kode_anggaran' => 'required',
            'jumlah_dana' => 'required',
            'lampiran_surat' => 'mimes:pdf'

        ]);
        DB::beginTransaction();
        try {


            $data_ktp = [];
            $data_rekening = [];
            $data_lampiransurat = [];
            if ($request->hasfile('file_ktp')) {
                $ktp_name =  "KTP-" . $kode_penerimahibah . "." . $request->file('file_ktp')->getClientOriginalExtension();
                $destination_ktp_path = "/public/doc-penerimahibah";
                $ktp = $ktp_name;
                $data_ktp = [
                    'file_ktp' => $ktp
                ];
            }

            if ($request->hasfile('file_rekening')) {
                $rekening_name =  "RK-" . $kode_penerimahibah . "." . $request->file('file_rekening')->getClientOriginalExtension();
                $destination_rekening_path = "/public/doc-penerimahibah";
                $rekening = $rekening_name;
                $data_rekening = [
                    'file_rekening' => $rekening
                ];
            }

            if ($request->hasfile('lampiran_surat')) {
                $lampiran_surat_name = $no_registrasi . "." . $request->file('lampiran_surat')->getClientOriginalExtension();
                $destinatio_lampiransurat_path = "/public/lampiran-surat";
                $lampiransurat = $lampiran_surat_name;
                $data_lampiransurat = [
                    'lampiran_surat' => $lampiransurat
                ];
            }
            $data_penerimahibah = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'latitude' => $request->latitiude,
                'longitude' => $request->longitude,
                'no_izin' => $request->no_izin,
                'no_telepon' => $request->no_telepon,
                'email' => $request->email,
                'penanggung_jawab' => $request->penanggung_jawab,
                'no_telepon_penanggung_jawab' => $request->no_telepon_penanggung_jawab,
                'email_penanggung_jawab' => $request->email_penanggung_jawab,
                'nama_bank' => $request->nama_bank,
                'no_rekening' => $request->no_rekening,
                'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
            ];


            $data = array_merge($data_penerimahibah, $data_ktp, $data_rekening);


            $update = Penerimahibah::where('kode_penerimahibah', $kode_penerimahibah)
                ->update($data);

            if ($update) {
                if ($request->hasfile('file_ktp')) {
                    Storage::delete($destination_ktp_path . "/" . $penerimahibah->file_ktp);
                    $request->file('file_ktp')->storeAs($destination_ktp_path, $ktp_name);
                }

                if ($request->hasfile('file_rekening')) {
                    Storage::delete($destination_ktp_path . "/" . $penerimahibah->file_rekening);
                    $request->file('file_rekening')->storeAs($destination_rekening_path, $rekening_name);
                }
            }

            $data_prop  = [
                'tanggal_proposal' => $request->tanggal_proposal,
                'kode_penerimahibah' => $kode_penerimahibah,
                'no_surat' => $request->no_surat,
                'tanggal_surat' => $request->tanggal_surat,
                'id_jenispengajuan_dana' => $request->id_jenispengajuan_dana,
                'kode_anggaran' => $request->kode_anggaran,
                'jumlah_dana' => toNumber($request->jumlah_dana),
                'judul_proposal' => $request->judul_proposal,
                'id_jenis_proposal' => 1
            ];

            $data_proposal = array_merge($data_prop, $data_lampiransurat);
            $updateproposal = Proposal::where('no_registrasi', $no_registrasi)->update($data_proposal);
            if ($updateproposal) {
                if ($request->hasfile('lampiran_surat')) {
                    Storage::delete($destinatio_lampiransurat_path . "/" . $proposal->lampiran_surat);
                    $request->file('lampiran_surat')->storeAs($destinatio_lampiransurat_path, $lampiran_surat_name);
                }
            }
            DB::commit();
            return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan']);
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show($no_registrasi)
    {
        $no_registrasi = Crypt::decrypt($no_registrasi);
        $proposal = Proposal::where('no_registrasi', $no_registrasi)
            ->join('penerimahibah', 'proposal.kode_penerimahibah', '=', 'penerimahibah.kode_penerimahibah')
            ->join('tahun_anggaran', 'proposal.kode_anggaran', '=', 'tahun_anggaran.kode_anggaran')
            ->join('jenis_pengajuan_dana', 'proposal.id_jenispengajuan_dana', '=', 'jenis_pengajuan_dana.id')
            ->first();
        return view('proposal.show', compact('proposal'));
    }


    public function destroy($no_registrasi)
    {
        $no_registrasi = Crypt::decrypt($no_registrasi);
        try {
            Proposal::where('no_registrasi', $no_registrasi)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }
}
