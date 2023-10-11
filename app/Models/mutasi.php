<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mutasi extends Model
{
    protected $guarded = ['id'];
    use HasFactory;


    public function pegawai(){
        return $this->belongsTo(Pegawai::class,'pegawai_id');
    }
    public function ruanganAwal(){
        return $this->belongsTo(Ruangan::class,'ruangan_awal_id');
    }
    public function ruanganTujuan(){
        return $this->belongsTo(Ruangan::class,'ruangan_tujuan_id');
    }
}
