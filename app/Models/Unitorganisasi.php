<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unitorganisasi extends Model
{
    use HasFactory;

    protected $table = "unit_organisasi";
    protected $guarded = [];
    protected $primaryKey = "kode_unit";
    public $incrementing = false;
}
