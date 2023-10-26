<?php

namespace App\Http\Livewire;

use App\Models\Pegawai;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public $results = [];
    public function render()
    {
        return view('livewire.search');
    }

    public function updated(){
        $this->results = Pegawai::all();
    }
}
