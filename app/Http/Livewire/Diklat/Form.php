<?php

namespace App\Http\Livewire\Diklat;

use App\Models\Pegawai;
use Livewire\Component;

class Form extends Component
{
    public $pegawai;
    public $ruangan_id;
    public $ruangan;


    public function mount()
    {
        $pegawai = Pegawai::find($this->pegawai);
        if ($pegawai) {
            $this->ruangan = $pegawai->ruangan->nama_ruangan;
        }
    }
    public function updatedPegawai()
    {
        $searchPegawai = Pegawai::find($this->pegawai);
        if ($searchPegawai) {
            $this->ruangan = $searchPegawai->ruangan->nama_ruangan;
            $this->ruangan_id = $searchPegawai->ruangan_id;
        }
    }


    public function render()
    {
        return view('livewire.diklat.form');
    }
}
