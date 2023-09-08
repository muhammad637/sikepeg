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

    public function str(){
        return $this->hasMany(STR::class);
    }

    public function sip(){
        return $this->hasMany(SIP::class);
    }

    public function umum(){
        return $this->hasOne(UmumStruktural::class);
    }
}
