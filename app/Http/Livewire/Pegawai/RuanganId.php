<?php

namespace App\Http\Livewire\Pegawai;

use App\Models\Ruangan;
use Livewire\Component;

class RuanganId extends Component
{
    public $ruangan_id;
    public $ruangans = [];
    public $nama_ruangan;
    public $pegawai;
   
    public function mount()
    {
        
        $this->ruangans = Ruangan::orderBy('nama_ruangan', 'asc')->get();
        $this->ruangan_id = old('ruangan_id',$this->ruangan_id);
        $this->nama_ruangan = old('nama_ruangan',null);
        // if($this->pegawai){
        //     $this->ruangan_id = old
        // }
    }
    public function render()
    {
        return view('livewire.pegawai.ruangan-id');
    }
}
