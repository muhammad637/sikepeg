<?php

namespace App\Http\Livewire\Mutasi;

use App\Models\Pegawai;
use App\Models\Ruangan;
use Livewire\Component;

class JenisMutasi extends Component
{

    public $jenis_mutasi;
    public $ruangans;
    public $ruangan_awal_id;
    public $ruangan_tujuan_id;
    public $tanggal_berlaku;
    public $no_sk;
    public $tanggal_sk;
    public $select_pegawai;
    public $link_sk;
    //eksternal
    public $instansi_awal = 'RSUD BLAMBANGAN';
    public $instansi_tujuan;
    public $tambah_ruangan_awal;
    public $tambah_ruangan_tujuan;


    public function mount(){
        $this->jenis_mutasi = old('jenis_mutasi', null);
        $this->ruangan_awal_id = old('ruangan_awal_id', null);
        $this->ruangan_tujuan_id = old('ruangan_tujuan_id', null);
        $this->tambah_ruangan_awal = old('tambah_ruangan_awal', null);
        $this->tambah_ruangan_tujuan = old('tambah_ruangan_tujuan', null);
        $this->instansi_awal = old('instansi_awal', 'rsud blambangan');
        $this->instansi_tujuan = old('instansi_tujuan', null);
        $this->ruangans = Ruangan::orderBy('nama_ruangan', 'asc')->get();
    }
    public function updatedSelectPegawai($value){
        $pegawai = Pegawai::find($value);
        if ($pegawai) {
            $this->ruangan_awal_id = $pegawai->ruangan->id;
        }
    }
    public function render()
    {

        return view('livewire.mutasi.jenis-mutasi', ['result' => Pegawai::all()]);
    }
}
