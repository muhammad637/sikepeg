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
        return $this->morphMany(Pegawai::class, 'statusable');
    }
}
