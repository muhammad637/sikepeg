<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PangkatGolongan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
    public function kenaikanPangkat()
    {
        return $this->hasMany(KenaikanPangkat::class);
    }
}
