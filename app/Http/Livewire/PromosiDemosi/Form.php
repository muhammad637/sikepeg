<?php

namespace App\Http\Livewire\PromosiDemosi;

use App\Models\Pegawai;
use Livewire\Component;

class Form extends Component
{
    public $pegawai;
    public $ruangan;
    public $jabatanLama;

    public function mount()
    {
        $pegawai = Pegawai::find($this->pegawai);
        if ($pegawai) {
            $this->ruangan = $pegawai->ruangan->nama_ruangan;
            $this->jabatanLama = $pegawai->jabatan;
        }
    }
    public function updatedPegawai()
    {
        $searchPegawai = Pegawai::find($this->pegawai);
        if ($searchPegawai) {
            $this->ruangan = $searchPegawai->ruangan->nama_ruangan;
            $this->jabatanLama = $searchPegawai->jabatan;
        }
    }
    public function render()
    {
        return view('livewire.promosi-demosi.form');
    }
}
