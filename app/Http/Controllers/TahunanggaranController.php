<?php

namespace App\Http\Controllers;

use App\Models\Tahunanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class TahunanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_anggaran = Tahunanggaran::orderBy('tahun')->get();
        return view('tahun_anggaran.index', compact('tahun_anggaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('tahun_anggaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Tahunanggaran::create([
                'kode_anggaran' => 'TA' . $request->tahun,
                'tahun' => $request->tahun,
                'jumlah_anggaran' => $request->jumlah_anggaran,
                'is_active' => 1
            ]);

            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kode_anggaran)
    {
        $kode_anggaran = Crypt::decrypt($kode_anggaran);
        $tahun_anggaran = Tahunanggaran::where('kode_anggaran', $kode_anggaran)->first();
        return view('tahun_anggaran.edit', compact('tahun_anggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kode_anggaran)
    {
        $kode_anggaran = Crypt::decrypt($kode_anggaran);
        try {
            Tahunanggaran::where('kode_anggaran', $kode_anggaran)->update([
                'tahun' => $request->tahun,
                'jumlah_anggaran' => $request->jumlah_anggaran
            ]);

            return Redirect::back()->with(['success' => 'Data Berhasil di Update']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => 'Data Gagal di Update']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode_anggaran)
    {
        $kode_anggaran = Crypt::decrypt($kode_anggaran);
        try {
            Tahunanggaran::where('kode_anggaran', $kode_anggaran)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }
}
