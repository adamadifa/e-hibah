<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahunanggaran extends Model
{
    use HasFactory;
    protected $table = "tahun_anggaran";
    protected $guarded = [];
    protected $primaryKey = "kode_anggaran";
    public $incrementing = false;
}
