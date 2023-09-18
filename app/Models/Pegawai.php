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
  
}
