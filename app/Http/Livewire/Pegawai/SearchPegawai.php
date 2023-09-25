<?php

namespace App\Http\Livewire\Pegawai;

use Carbon\Carbon;
use App\Models\Pegawai;
use Livewire\Component;

class SearchPegawai extends Component
{
    public $select = '';
    public $dokumen;
    public $alamat;
    public $results = [];
    public $selectedNIK;
    public $selectId;
    public $selectedNIP;
    public $selectedRuangan;
    public $selectedjenisKelamin;
    public $selectedTempatTanggalLahir;
    public $selectedNoIjazah;
    public $selectedSekolah;
    public $selectedTanggalLulus;
    public $pegawai;
    public $pegawaiedit;

    // public $pegawai;

    public function mount(){ 
        // $this->pegawaiedit;
        
        
    }

    public function updatedSelect($value)
    {
        $this->select = $value;
        $this->pegawai = Pegawai::find($this->select);
        if ($this->pegawai) {
            $this->selectId = $this->pegawai->id;
            $this->alamat = $this->pegawai->id;
            $this->selectedNIK = $this->pegawai->nik;
            $this->selectedNIP = $this->pegawai->nip_nippk;
            $this->selectedRuangan = $this->pegawai->ruangan;
            $this->selectedjenisKelamin = $this->pegawai->jenis_kelamin;
            $this->selectedNoIjazah = $this->pegawai->no_ijazah;
            $this->selectedTanggalLulus = $this->pegawai->tanggal_lulus;
            $this->selectedSekolah = $this->pegawai->sekolah;
            $this->selectedTempatTanggalLahir = $this->pegawai->tempat_lahir . ", " . Carbon::parse($this->pegawai->tanggal_lahir)->format('d-M-Y');
        } else {
            $this->select = '';
        }
    }
    public function render()
    {
        $this->select = $this->pegawaiedit;
        $this->pegawai = Pegawai::find($this->select);
        return view('livewire.pegawai.search-pegawai',[
            'selectId' => $this->pegawai->id ?? null,
            'alamat' => $this->pegawai->id ?? null,
            'selectedNIK' => $this->pegawai->nik ?? null,
            'selectedNIP' => $this->pegawai->nip_nippk ?? null,
            'selectedRuangan' => $this->pegawai->ruangan ?? null,
            'selectedjenisKelamin' => $this->pegawai->jenis_kelamin ?? null,
            'selectedNoIjazah' => $this->pegawai->no_ijazah ?? null,
            'selectedTanggalLulus' => $this->pegawai->tanggal_lulus ?? null,
            'selectedSekolah' => $this->pegawai->sekolah ?? null,
            'selectedTempatTanggalLahir' => $this->pegawai->tempat_lahir . ", " . Carbon::parse($this->pegawai->tanggal_lahir)->format('d-M-Y') ?? null,
        ]);
    }
}
