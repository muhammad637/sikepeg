<?php

namespace App\Http\Livewire\PromosiDemosi;

use App\Models\Pegawai;
use App\Models\Ruangan;
use Livewire\Component;

class Form extends Component
{
    public $pegawai;
    public $ruangan_id;
    public $ruangan;
    public $ruanganbaru_id;
    public $ruanganlama_id;
    public $jabatanLama;
    public $ruangans;

    public function mount()
    {
        $pegawai = Pegawai::find($this->pegawai); $this->ruangans= Ruangan::all(); $this->ruanganbaru_id = old('ruanganbaru_id', null);
        if ($pegawai) {
            $this->ruangan = $pegawai->ruangan->nama_ruangan;
            $this->ruangan_id = $pegawai->ruangan->id;
            $this->jabatanLama = $pegawai->jabatan;
        }
    }
    public function updatedPegawai()
    {
        $searchPegawai = Pegawai::find($this->pegawai);
        if ($searchPegawai) {
            $this->ruangan = $searchPegawai->ruangan->nama_ruangan;
            $this->ruangan_id = $searchPegawai->ruangan_id;
            $this->jabatanLama = $searchPegawai->jabatan;
        }
    }
    public function render()
    {
        return view('livewire.promosi-demosi.form');
    }
}
