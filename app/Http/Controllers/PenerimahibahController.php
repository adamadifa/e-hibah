<?php

namespace App\Http\Controllers;

use App\Models\Penerimahibah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class PenerimahibahController extends Controller
{
    public function index(Request $request)
    {
        $query = Penerimahibah::query();
        if ($request->nama) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }
        $penerimahibah = $query->paginate(10);
        $penerimahibah->appends(request()->all());
        return view('penerimahibah.index', compact('penerimahibah'));
    }

    public function create()
    {
        return view('penerimahibah.create');
    }

    public function edit($kode_penerimahibah)
    {
        $kode_penerimahibah = Crypt::decrypt($kode_penerimahibah);
        $penerimahibah = Penerimahibah::where('kode_penerimahibah', $kode_penerimahibah)->first();
        return view('penerimahibah.edit', compact('penerimahibah'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|numeric',
            'email' => 'email',
            'penanggung_jawab' => 'required',
            'no_telepon_penanggung_jawab' => 'required|numeric',
            'email_penanggung_jawab' => 'email',
            'file_ktp' => 'required|max:1024',
            'nama_bank' => 'required',
            'no_rekening' => 'required|numeric',
            'nama_pemilik_rekening' => 'required',
            'file_rekening' => 'required|max:1024'
        ]);

        try {
            //Cek Last Kode

            $lastpenerimahibah = Penerimahibah::orderBy('kode_penerimahibah', 'desc')->first();
            $last_kode_penerimahibah = $lastpenerimahibah != null ? $lastpenerimahibah->kode_penerimahibah : '';
            $kode_penerimahibah = buatkode($last_kode_penerimahibah, "PH-" . date('y'), 5);

            if ($request->hasfile('file_ktp')) {
                $image = $request->file('file_ktp');
                $image_name =  "KTP-" . $kode_penerimahibah . "." . $request->file('file_ktp')->getClientOriginalExtension();
                $destination_path = "/public/doc-penerimahibah";
                $upload = $request->file('file_ktp')->storeAs($destination_path, $image_name);
                $ktp = $image_name;
            } else {
                $ktp = NULL;
            }

            if ($request->hasfile('file_rekening')) {
                $image = $request->file('file_rekening');
                $image_name =  "RK-" . $kode_penerimahibah . "." . $request->file('file_rekening')->getClientOriginalExtension();
                $destination_path = "/public/doc-penerimahibah";
                $upload = $request->file('file_rekening')->storeAs($destination_path, $image_name);
                $rekening = $image_name;
            } else {
                $rekening = NULL;
            }
            Penerimahibah::create([
                'kode_penerimahibah' => $kode_penerimahibah,
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
                'file_ktp' => $ktp,
                'nama_bank' => $request->nama_bank,
                'no_rekening' => $request->no_rekening,
                'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
                'file_rekening' => $rekening,

            ]);

            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }

    public function update($kode_penerimahibah, Request $request)
    {
        $kode_penerimahibah = Crypt::decrypt($kode_penerimahibah);
        $penerimahibah = Penerimahibah::where('kode_penerimahibah', $kode_penerimahibah)->first();
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|numeric',
            'email' => 'email',
            'penanggung_jawab' => 'required',
            'no_telepon_penanggung_jawab' => 'required|numeric',
            'email_penanggung_jawab' => 'email',
            'file_ktp' => 'mimes:jpg,jpeg,png|max:1024',
            'nama_bank' => 'required',
            'no_rekening' => 'required|numeric',
            'nama_pemilik_rekening' => 'required',
            'file_rekening' => 'mimes:jpg,jpeg,png|max:1024'
        ]);

        try {

            if ($request->hasfile('file_ktp')) {
                $image = $request->file('file_ktp');
                $image_name =  "KTP-" . $kode_penerimahibah . "." . $request->file('file_ktp')->getClientOriginalExtension();
                $destination_path = "/public/doc-penerimahibah";
                $ktp = $image_name;
            } else {
                $ktp = $penerimahibah->file_ktp;
            }

            if ($request->hasfile('file_rekening')) {
                $image = $request->file('file_rekening');
                $image_name =  "RK-" . $kode_penerimahibah . "." . $request->file('file_rekening')->getClientOriginalExtension();
                $destination_path = "/public/doc-penerimahibah";
                $rekening = $image_name;
            } else {
                $rekening = $penerimahibah->file_rekening;
            }
            $update = Penerimahibah::where('kode_penerimahibah', $kode_penerimahibah)
                ->update([
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
                    'file_ktp' => $ktp,
                    'nama_bank' => $request->nama_bank,
                    'no_rekening' => $request->no_rekening,
                    'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
                    'file_rekening' => $rekening,

                ]);

            if ($update) {
                if ($request->hasfile('file_ktp')) {
                    $request->file('file_ktp')->storeAs($destination_path, $image_name);
                }

                if ($request->hasfile('file_rekening')) {
                    $request->file('file_rekening')->storeAs($destination_path, $image_name);
                }
            }

            return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($kode_penerimahibah)
    {
        $kode_penerimahibah = Crypt::decrypt($kode_penerimahibah);
        try {
            Penerimahibah::where('kode_penerimahibah', $kode_penerimahibah)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }


    public function show($kode_penerimahibah)
    {
        $kode_penerimahibah = Crypt::decrypt($kode_penerimahibah);
        $penerimahibah = Penerimahibah::where('kode_penerimahibah', $kode_penerimahibah)->first();
        return view('penerimahibah.show', compact('penerimahibah'));
    }
}
