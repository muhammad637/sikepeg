<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function statusable()
    {
        return $this->morphTo();
    }

    public function umumStruktural()
    {
        return $this->hasOne(UmumStruktural::class, 'asn_id');
    }

    public function str()
    {
        return $this->hasMany(STR::class, 'asn_id');
    }

    public function sip()
    {
        return $this->hasMany(SIP::class, 'asn_id');
    }
  
}
