<?php

namespace App\Http\Livewire\KenaikanPangkat;

use App\Models\Pegawai;
use App\Models\Golongan;
use App\Models\Pangkat;
use Livewire\Component;

class EditJenisGolongan extends Component
{
    public $kenaikan_pangkat;
    public $pegawai;
    public $status_tipe;
    public $golongan_id;
    public $pangkat_id;
    public $resultGolongan = [];
    public $resultPangkat = [];
    public function mount(){
        $pegawai = Pegawai::find($this->pegawai);
        $this->golongan_id = old('golongan_id', $this->kenaikan_pangkat->golongan_id);
        $this->pangkat_id = old('pangkat_id', $this->kenaikan_pangkat->pangkat_id);
        if($pegawai){
            $this->status_tipe =  $pegawai->status_tipe;  
            $this->resultGolongan =  Golongan::where('jenis', $pegawai->status_tipe)->orderBy('nama_golongan', 'asc')->get();
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
