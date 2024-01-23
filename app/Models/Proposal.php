<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $table = "proposal";
    protected $guarded = [];
    protected $primaryKey = "no_registrasi";
    public $incrementing = false;
}
