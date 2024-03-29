<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Diklat extends Model
{
    protected $guarded = ['id'];
    use HasFactory;


    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
    public function ruangan(){
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
