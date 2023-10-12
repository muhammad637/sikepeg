<?php

namespace App\Http\Livewire\KenaikanPangkat;

use App\Models\Pegawai;
use App\Models\Golongan;
use App\Models\Pangkat;
use Livewire\Component;

class JenisPangkatGolongan extends Component
{
    public $pegawai;
    public $status_tipe;
    public $golongan_id;
    public $pangkat_id;
    public $nama_pangkat;
    public $nama_golongan;
    public $resultGolongan = [];
    public $resultPangkat = [];
    public $jabatan;
    public function mount(){
      $this->pegawai = old('pegawai', null);
      if($this->pegawai){
        $this->resultGolongan =
            Golongan::where('jenis', $this->pegawai->status_tipe)->orderBy('nama_golongan','asc')->get();
        $this->resultPangkat =
            Pangkat::orderBy('nama_pangkat', 'asc')->get();
            $this->jabatan = old('jabatan',$this->pegawai->jabatan);
        } 
        $this->pangkat_id = old('pangkat_id', null);
        $this->golongan_id = old('golongan_id', null);
        $this->nama_golongan = old('nama_golongan', null);
        $this->nama_pangkat = old('nama_pangkat', null);
      
        $this->jabatan = old('jabatan', null);
    }
    public function updatedPegawai($value){
        $pegawai = Pegawai::find($value);
        if($pegawai ){
            $this->status_tipe = $pegawai->status_tipe ?? 'pns';
            $this->resultGolongan = Golongan::where('jenis', $pegawai->status_tipe)->get();
            $this->resultPangkat = Pangkat::all();
        }
    }
    
    
    
    
    public function render()
    {
        return view('livewire.kenaikan-pangkat.jenis-pangkat-golongan');
    }
    
}
