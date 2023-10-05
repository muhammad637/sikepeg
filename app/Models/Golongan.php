<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    public $guarded = ['id'];





    public function kenaikanpangkat(){
        return $this->hasMany(KenaikanPangkat::class);
    }

    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}