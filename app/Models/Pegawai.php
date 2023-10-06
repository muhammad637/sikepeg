<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Pegawai extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'pegawai';
    protected $fillable = [

        'nik',
        'nip_nippk',
        'gelar_depan',
        'gelar_belakang',
        'nama_depan',
        'nama_belakang',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'agama',
        'no_wa',
        'status_pegawai',
        'ruangan',
        'tahun_pensiun',
        'pendidikan_terakhir',
        'tanggal_lulus',
        'status_tenaga',
        'no_ijazah',
        'jabatan',

        'tanggal_masuk',
        'niPtt_pkThl',
 
        'sekolah',
        'tmt_cpns',
        'tmt_pns',
        'tmt_pangkat_terakhir',
        'pangkat_golongan',
        'jenis_tenaga',
        'no_str',
        'tanggal_terbit_str',
        'masa_berakhir_str',
        'link_str',
        'no_sip',
        'tanggal_terbit_sip',
        'masa_berlaku_sip',
        'link_sip',
        'masa_kerja',
        'no_karpeg',
        'no_taspen',
        'no_npwp',
        'no_hp',
        'email',
        'pelatihan',
    ];
    protected $hidden = ['password'];

    public function str()
    {
        return $this->hasMany(STR::class);
    }
    public function sip()
    {
        return $this->hasMany(SIP::class);
    }

    public function mutasi(){
        return $this->hasMany(Mutasi::class);
    }
    public function diklat(){
        return $this->hasMany(Diklat::class);
    }
    public function cuti(){
        return $this->hasMany(Cuti::class);

    }

    public function kenaikanpangkat(){
        return $this->hasMany(KenaikanPangkat::class);
    }
  
}
