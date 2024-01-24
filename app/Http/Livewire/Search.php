<?php

namespace App\Http\Livewire;

use App\Models\Pegawai;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public $showResult = false;
    public $results = [];
    public function render()
    {
        return view('livewire.search');
    }
    public function updatedSearch(){
        if (empty($this->search)) {
            $this->showResult = false;
        }
    }
    public function updated(){
        
        $namaRuangan = $this->search;
        $this->results =
        Pegawai::whereHas('ruangan', function ($query) use ($namaRuangan) {
            $query->where('nama_ruangan', 'like', '%' . $namaRuangan . '%');
        })
        ->orWhere('nip_nippk', 'like', '%' . $this->search . '%')
        ->orWhere('nama_lengkap', 'like', '%' . $this->search . '%')
        ->orWhere('nama_depan', 'like', '%' . $this->search . '%')
        ->orWhere('status_tenaga', 'like', '%' . $this->search . '%')
        ->get();
        
        if ($this->results->count() > 0) {
            $this->showResult = true;
        }
    }
}
