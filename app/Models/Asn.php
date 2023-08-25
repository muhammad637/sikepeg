<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asn extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
    public function SIP()
    {
        return $this->hasMany(SIP::class);
    }
    public function STR()
    {
        return $this->hasMany(STR::class);
    }
    public function umum()
    {
        return $this->hasMany(UmumStruktural::class);
    }
}
