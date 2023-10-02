<?php

namespace App\Http\Livewire\KenaikanPangkat;

use App\Models\Pegawai;
use App\Models\Golongan;
use App\Models\Pangkat;
use Livewire\Component;

class EditJenisGolongan extends Component
{
    public $pegawai;
    public $status_tipe;
    public $golongan;
    public $pangkat;
    public $resultGolongan = [];
    public $resultPangkat = [];
    public function updatedPegawai($value){
        $pegawai = Pegawai::find($value);
        $this->status_tipe = $pegawai->status_tipe ?? 'pns';
        $this->resultGolongan = Golongan::where('jenis', $pegawai->status_tipe)->get();
        $this->resultPangkat = Pangkat::all();
    }
    
    
    
    
    public function render()
    {
        return view('livewire.kenaikan-pangkat.edit-jenis-golongan');
    }
    
}
