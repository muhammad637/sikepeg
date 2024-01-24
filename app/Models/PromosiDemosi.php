<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromosiDemosi extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
    public function ruanganawal()
    {
        return $this->belongsTo(Ruangan::class, 'ruanganawal_id');
    }

    public function ruanganbaru()
    {
        return $this->belongsTo(Ruangan::class, 'ruanganbaru_id');
    }
}
