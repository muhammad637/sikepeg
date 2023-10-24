<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pegawai extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'pegawai';
    protected $guarded = ['id'];
    protected $hidden = ['password'];

    public function str()
    {
        return $this->hasMany(STR::class);
    }
    public function sip()
    {
        return $this->hasMany(SIP::class);
    }

    public function mutasi()
    {
        return $this->hasMany(Mutasi::class);
    }
    public function diklat()
    {
        return $this->hasMany(Diklat::class);
    }
    public function cuti()
    {
        return $this->hasMany(Cuti::class);
    }

    public function kenaikanpangkat()
    {
        return $this->hasMany(KenaikanPangkat::class);
    }
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }
    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'pangkat_id');
    }
    public function ruangan(){
        return $this->belongsTo(Ruangan::class,'ruangan_id');
    }
   
}

