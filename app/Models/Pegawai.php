<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function str()
    {
        return $this->hasMany(STR::class);
    }
    public function sip()
    {
        return $this->hasMany(SIP::class);
    }

    public function mutasi(){
        return $this->hasMany(Mutasi::class);
    }
    public function diklat(){
        return $this->hasMany(Diklat::class);
    }
    public function cuti(){
        return $this->hasMany(Cuti::class);

    }

    public function kenaikanpangkat(){
        return $this->hasMany(KenaikanPangkat::class);
    }
    public function golongan(){
        return $this->hasMany(Golongan::class);
    }
    public function pangkat(){
        return $this->hasMany(Pangkat::class);
    }
  
}
