<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmumStruktural extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function asn()
    {
        return $this->belongsTo(Asn::class, 'asn_id');
    }
}
