<?php

namespace App\Http\Livewire\Pegawai;

use App\Models\Ruangan;
use Livewire\Component;

class RuanganId extends Component
{
    public $ruangan_id;
    public $ruangans = [];
    public $nama_ruangan;
   
    public function mount()
    {
        // $this->tes = old('nama_ruangan');
        $this->ruangans = Ruangan::orderBy('nama_ruangan', 'asc')->get();
        // $ruangan = Ruangan::where('nama_ruangan',old('nama_ruangan'))->first();
        // $this->ruangan_id = $ruangan->id;
        // $this->tes = old('nama_ruangan');
        $this->ruangan_id = old('ruangan_id',null);
        $this->nama_ruangan = old('nama_ruangan',null);
    }
    public function render()
    {
        return view('livewire.pegawai.ruangan-id');
    }
}
