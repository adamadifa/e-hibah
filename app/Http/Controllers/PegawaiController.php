<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Unitorganisasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pegawai::query();
        $query->select('pegawai.*', 'nama_jabatan', 'nama_unit', 'nama_organisasi', 'status', 'users.id as id_user', 'username');
        $query->join('jabatan', 'pegawai.kode_jabatan', '=', 'jabatan.kode_jabatan');
        $query->join('unit_organisasi', 'pegawai.kode_unit', '=', 'unit_organisasi.kode_unit');
        $query->join('organisasi', 'unit_organisasi.kode_organisasi', '=', 'organisasi.kode_organisasi');
        $query->join('status_pns', 'pegawai.kode_status_pns', '=', 'status_pns.kode_status_pns');
        $query->leftJoin('users', 'pegawai.nip', '=', 'users.nip');
        if (!empty($request->nama_pegawai)) {
            $query->where('nama_pegawai', 'like', '%' . $request->nama_pegawai . '%');
        }
        $pegawai = $query->paginate(30);
        $pegawai->appends(request()->all());
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        $jabatan = Jabatan::orderBy('kode_jabatan')->get();
        $unit_organisasi = Unitorganisasi::orderBy('kode_unit')->get();
        $status_pns = DB::table('status_pns')->orderBy('kode_status_pns')->get();
        return view('pegawai.create', compact('jabatan', 'unit_organisasi', 'status_pns'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:pegawai',
            'nama_pegawai' => 'required',
            'kode_jabatan' => 'required',
            'kode_unit' => 'required',
            'kode_status_pns' => 'required'
        ]);

        try {
            Pegawai::create([
                'nip' => $request->nip,
                'nama_pegawai' => $request->nama_pegawai,
                'kode_jabatan' => $request->kode_jabatan,
                'kode_unit' => $request->kode_unit,
                'kode_status_pns' => $request->kode_status_pns,
                'is_active' => 1
            ]);

            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }


    public function edit($nip)
    {
        $nip = Crypt::decrypt($nip);
        $jabatan = Jabatan::orderBy('kode_jabatan')->get();
        $unit_organisasi = Unitorganisasi::orderBy('kode_unit')->get();
        $status_pns = DB::table('status_pns')->orderBy('kode_status_pns')->get();
        $pegawai = Pegawai::where('nip', $nip)->first();
        return view('pegawai.edit', compact('jabatan', 'unit_organisasi', 'status_pns', 'pegawai'));
    }


    public function update($nip, Request $request)
    {
        $nip = Crypt::decrypt($nip);
        $request->validate([

            'nama_pegawai' => 'required',
            'kode_jabatan' => 'required',
            'kode_unit' => 'required',
            'kode_status_pns' => 'required'
        ]);

        try {
            Pegawai::where('nip', $nip)->update([
                'nama_pegawai' => $request->nama_pegawai,
                'kode_jabatan' => $request->kode_jabatan,
                'kode_unit' => $request->kode_unit,
                'kode_status_pns' => $request->kode_status_pns,
                'is_active' => 1
            ]);

            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }


    public function createakun($nip)
    {
        $nip = Crypt::decrypt($nip);
        $pegawai = Pegawai::where('nip', $nip)
            ->select('pegawai.*', 'nama_jabatan', 'nama_unit', 'nama_organisasi', 'status')
            ->join('jabatan', 'pegawai.kode_jabatan', '=', 'jabatan.kode_jabatan')
            ->join('unit_organisasi', 'pegawai.kode_unit', '=', 'unit_organisasi.kode_unit')
            ->join('organisasi', 'unit_organisasi.kode_organisasi', '=', 'organisasi.kode_organisasi')
            ->join('status_pns', 'pegawai.kode_status_pns', '=', 'status_pns.kode_status_pns')
            ->first();
        $roles = Role::orderBy('name')->get();
        return view('pegawai.createakun', compact('pegawai', 'roles'));
    }

    public function editakun($nip)
    {
        $nip = Crypt::decrypt($nip);
        $pegawai = Pegawai::where('nip', $nip)
            ->select('pegawai.*', 'nama_jabatan', 'nama_unit', 'nama_organisasi', 'status')
            ->join('jabatan', 'pegawai.kode_jabatan', '=', 'jabatan.kode_jabatan')
            ->join('unit_organisasi', 'pegawai.kode_unit', '=', 'unit_organisasi.kode_unit')
            ->join('organisasi', 'unit_organisasi.kode_organisasi', '=', 'organisasi.kode_organisasi')
            ->join('status_pns', 'pegawai.kode_status_pns', '=', 'status_pns.kode_status_pns')
            ->first();
        $user = User::with('roles')->where('nip', $nip)->first();
        $roles = Role::orderBy('name')->get();
        return view('pegawai.editakun', compact('pegawai', 'roles', 'user'));
    }

    public function destroy($nip)
    {
        $nip = Crypt::decrypt($nip);
        try {
            Pegawai::where('nip', $nip)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }
}
