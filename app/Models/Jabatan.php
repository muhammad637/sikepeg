<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}

