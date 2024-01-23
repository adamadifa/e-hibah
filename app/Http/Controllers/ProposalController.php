<?php

namespace App\Http\Controllers;

use App\Models\Jenispengajuandana;
use App\Models\Penerimahibah;
use App\Models\Tahunanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProposalController extends Controller
{
    public function create($kode_penerimahibah)
    {
        $kode_penerimahibah = Crypt::decrypt($kode_penerimahibah);
        $penerimahibah = Penerimahibah::where('kode_penerimahibah', $kode_penerimahibah)->first();
        $jenis_pengajuan_dana = Jenispengajuandana::orderBy('id')->get();
        $tahun_anggaran = Tahunanggaran::orderBy('tahun')->get();
        return view('proposal.create', compact('penerimahibah', 'jenis_pengajuan_dana', 'tahun_anggaran'));
    }
}
