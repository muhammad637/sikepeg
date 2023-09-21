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
    // public $pegawai;

    public function updatedSelect($value)
    {
        $this->select = $value;
        $pegawai = Pegawai::find($this->select);
        if ($pegawai) {
            $this->selectId = $pegawai->id;
            $this->alamat = $pegawai->id;
            $this->selectedNIK = $pegawai->nik;
            $this->selectedNIP = $pegawai->nip_nippk;
            $this->selectedRuangan = $pegawai->ruangan;
            $this->selectedjenisKelamin = $pegawai->jenis_kelamin;
            $this->selectedNoIjazah = $pegawai->no_ijazah;
            $this->selectedTanggalLulus = $pegawai->tanggal_lulus;
            $this->selectedSekolah = $pegawai->sekolah;
            $this->selectedTempatTanggalLahir = $pegawai->tempat_lahir . ", " . Carbon::parse($pegawai->tanggal_lahir)->format('d-M-Y');
        } else {
            $this->select = '';
        }
    }
    public function render()
    {
        $this->results = Pegawai::where('status_tenaga', 'asn')->where('jenis_tenaga', 'nakes')->get();
        // $this->select = old('pegawai_id');
        return view('livewire.pegawai.search-pegawai');
    }
}
