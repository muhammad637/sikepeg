<?php

namespace App\Http\Livewire\Mutasi;

use App\Models\mutasi;
use App\Models\Pegawai;
use Livewire\Component;

class JenisMutasiEdit extends Component
{

    // public $result;




    public $mutasi;
    public $jenis_mutasi;
    public $ruangan_awal;
    public $ruangan_tujuan;
    public $tanggal_berlaku;
    public $no_sk;
    public $tanggal_sk;
    public $select_pegawai;
    public $link_sk;
    //eksternal
    public $instansi_awal;
    public $instansi_tujuan;


    public function mount(){

        $this->jenis_mutasi = old('jenis_mutasi', $this -> mutasi-> jenis_mutasi);
        $this->ruangan_awal = old('ruangan_awal', $this -> mutasi-> ruangan_awal ?? null);
        $this->ruangan_tujuan = old('ruangan_tujuan', $this -> mutasi-> ruangan_tujuan ?? null);
        $this->tanggal_berlaku = old('tanggal_berlaku', $this -> mutasi-> tanggal_berlaku ?? null);
        $this->no_sk = old('no_sk', $this -> mutasi-> no_sk ?? null);
        $this->tanggal_sk = old('tanggal_sk', $this -> mutasi-> tanggal_sk ?? null);
        $this->instansi_awal = old('instansi_awal', $this -> mutasi-> instansi_awal ?? null);
        $this->instansi_tujuan = old('instansi_tujuan', $this -> mutasi-> instansi_tujuan ?? null);
        $this->link_sk = old('link_sk', $this -> mutasi-> link_sk ?? null);



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

        return view('livewire.mutasi.jenis-mutasi-edit');
    }
}
