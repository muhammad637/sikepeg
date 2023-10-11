<?php

namespace App\Http\Livewire\Pegawai;

use App\Models\Ruangan;
use Livewire\Component;

class RuanganId extends Component
{
    public $ruangan_id;
    public $ruangans = [];
    public $nama_ruangan;
    public function mount(){
        $this->ruangans = Ruangan::orderBy('nama_ruangan','asc')->get();
    }
    public function render()
    {
        return view('livewire.pegawai.ruangan-id');
    }
}
