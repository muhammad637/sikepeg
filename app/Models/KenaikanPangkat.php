<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KenaikanPangkat extends Model
{

    protected $guarded = ['id'];
    use HasFactory;


    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }


    public function pangkatGolongan(){
        return $this->belongsTo(PangkatGolongan::class, 'pangkat_golongan_id');
    }
    public function pangkatGolonganSebelumnya(){
        return $this->belongsTo(PangkatGolongan::class, 'pangkat_golongan_sebelumnya_id');
    }
    
    public function pangkat(){
        return $this->belongsTo(Pangkat::class, 'pangkat_id');
    }


    public function golongan(){
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }

    public function ruangan(){
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
