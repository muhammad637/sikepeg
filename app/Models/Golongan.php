<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($golongan) {
    //         self::validateGolonganStatus($golongan);
    //     });

    //     static::updating(function ($golongan) {
    //         self::validateGolonganStatus($golongan);
    //     });
    // }

    // private static function validateGolonganStatus($golongan)
    // {
    //     $existingGolongan = self::where('jenis', $golongan->jenis)
    //         ->where('nama_golongan', $golongan->nama_golongan)
    //         ->where('id', '<>', $golongan->id ?? 0)
    //         ->first();

    //     if ($existingGolongan) {
    //         throw new \Exception('Golongan dengan jenis yang sama sudah ada.');
    //     }
    // }

    public function kenaikanpangkat(){
        return $this->hasMany(KenaikanPangkat::class);
    }

    public function pegawai(){
        return $this->hasMany(Pegawai::class);
    }
}