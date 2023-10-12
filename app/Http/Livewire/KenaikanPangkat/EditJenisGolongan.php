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
    public $golongan_id;
    public $pangkat_id;
    public $resultGolongan = [];
    public $resultPangkat = [];
    public function mount(){
        if($this->pegawai){
            $this->status_tipe =  $this->pegawai->status_tipe;  
            $this->golongan_id = old('golongan_id', $this->pegawai->golongan_id);
            $this->pangkat_id = old('pangkat_id', $this->pegawai->pangkat_id);
            $this->resultGolongan =  Golongan::where('jenis', $this->pegawai->status_tipe)->orderBy('nama_golongan', 'asc')->get();
            $this->resultPangkat =  pangkat::orderBy('nama_pangkat', 'asc')->get();
        }
    }
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
