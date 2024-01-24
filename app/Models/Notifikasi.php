<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pegawai(){
        return $this->belongsToMany(Pegawai::class,'notifikasi_pegawai');
    }
    public function admin(){
        return $this->belongsToMany(Admin::class,'notifikasi_admin');
    }

    public static function notif($jenis,$pesan,$status,$icon){
        return [
            'jenis_notifikasi' => $jenis,
            'pesan' => $pesan,
            'icon' => $icon,
            'status' => $status,
            'dibaca' => false,
        ];
    }
}
