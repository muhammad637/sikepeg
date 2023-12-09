<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mutasi(){
        return $this->hasMany(Mutasi::class);
    }
    public function pegawai(){
        return $this->hasMany(Pegawai::class);
    }
    public function promosiDemosi(){
        return $this->hasMany(PromosiDemosi::class);
    }

}
