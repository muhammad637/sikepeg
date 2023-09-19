<?php

namespace App\Http\Livewire\Mutasi;

use App\Models\Pegawai;
use Livewire\Component;

class JenisMutasi extends Component
{

    // public $result;





    public $jenis_mutasi;
    public $ruangan_awal;
    public $ruangan_tujuan;
    public $tanggal_berlaku;
    public $no_sk;
    public $tanggal_sk;
    public $select_pegawai;
    
    //eksternal
    public $instansi_awal;
    public $instansi_tujuan;


    public function mount(){

        $this->jenis_mutasi = old('jenis_mutasi', null);
        $this->ruangan_awal = old('ruangan_awal', null);
        $this->ruangan_tujuan = old('ruangan_tujuan', null);
        $this->tanggal_berlaku = old('tanggal_berlaku', null);
        $this->no_sk = old('no_sk', null);
        $this->tanggal_sk = old('tanggal_sk', null);
        $this->instansi_awal = old('instansi_awal', null);
        $this->instansi_tujuan = old('instansi_tujuan', null);




    }


    public function updatedJenisMustasi($value)
    {
        $this->jenis_mutasi = $value;
        // old(['status_tenaga' => $value]);
    }

    public function updatedSelectPegawai($value){
        $pegawai = Pegawai::find($value);
        if ($pegawai) {
            $this->ruangan_awal = $pegawai->ruangan;
            # code...
        }
    }


    public function render()
    {

        return view('livewire.mutasi.jenis-mutasi', ['result' => Pegawai::all()]);
    }
}
