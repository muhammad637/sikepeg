<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function kenaikanpangkat(){
        return $this->hasMany(KenaikanPangkat::class);
    }
    public function pegawai(){
        return $this->hasMany(Pegawai::class);
    }
}
