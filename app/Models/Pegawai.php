<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function asn()
    {
        return $this->hasOne(Asn::class);
    }
    public function nonAsn()
    {
        return $this->hasOne(NonAsn::class);
    }

  
}
