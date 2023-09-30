<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuti extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'mulai_cuti',
    //     'selesai_cuti',
    //     'pegawai_id',
    //     'jenis_cuti',
    //     ''
    // ];
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    // protected static function boot()
    // {
    //     parent::boot();
    //     // static::created(function ($cuti) {
    //     //     $tanggal_mulai = Carbon::parse($cuti->mulai_cuti);
    //     //     $tanggal_selesai = Carbon::parse($cuti->selesai_cuti);
    //     //     $tanggal_hari_ini = Carbon::today();
    //     //     if ($tanggal_hari_ini <= $tanggal_selesai && $tanggal_hari_ini >= $tanggal_mulai) {
    //     //         $cuti->updatedStatusPegawai('nonaktif');
    //     //     }
    //     // });
    // }
    // public function updatedStatusPegawai($status)
    // {
    //     $this->pegawai->update(['status' => $status]);
    // }
}
