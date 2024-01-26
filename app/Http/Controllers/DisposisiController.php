<?php

namespace App\Http\Controllers;

use App\Models\Jenispengajuandana;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DisposisiController extends Controller
{
    public function create($no_registrasi)
    {
        $no_registrasi = Crypt::decrypt($no_registrasi);
        $users = User::orderBy('id')->get();
        $jenis_pengajuan_dana = Jenispengajuandana::orderBy('id')->get();
        return view('disposisi.create', compact('users', 'jenis_pengajuan_dana'));
    }
}
