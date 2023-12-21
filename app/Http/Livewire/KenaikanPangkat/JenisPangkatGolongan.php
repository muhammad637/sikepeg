<?php

namespace App\Http\Livewire\KenaikanPangkat;

use App\Models\Pangkat;
use App\Models\Pegawai;
use Livewire\Component;
use App\Models\Golongan;
use App\Models\PangkatGolongan;

class JenisPangkatGolongan extends Component
{
    public $pegawai;
    public $kenaikan_pangkat;
    public $status_tipe;
    public $golongan_id;
    public $pangkat_id;
    public $pangkat_golongan_id;
    public $pangkat_golongan_sebelumnya_id;
    public $nama_pangkat_golongan;
    public $nama_pangkat_golongan_sebelumnya;
    public $nama_pangkat;
    public $nama_golongan;
    public $resultGolongan = [];
    public $resultPangkat = [];
    public $pangkatGolongan = [];
    public $jabatan;
    public $ruangan;
    public $ruangan_id;
    public function mount()
    {
        $this->pegawai = old('pegawai', null);
        $this->pangkat_id = old('pangkat_id', null);
        $this->pangkat_golongan_id = old('pangkat_golongan_id', null);
        $this->pangkat_golongan_sebelumnya_id = old('pangkat_golongan_sebelumnya_id', null);
        $this->golongan_id = old('golongan_id', null);
        $this->nama_golongan = old('nama_golongan', null);
        $this->nama_pangkat = old('nama_pangkat', null);
        $this->jabatan = old('jabatan', null);
        $this->ruangan = old('ruangan', null);
        if ($this->pegawai != null) {
            $this->pangkatGolongan =
                PangkatGolongan::all();
            $this->jabatan = old('jabatan', $this->pegawai->jabatan);
            $this->pangkat_golongan_sebelumnya_id = $this->pegawai->pangkat_golongan_id;
            $this->nama_pangkat_golongan_sebelumnya = $this->pegawai->pangkatGolongan->nama;
            $this->ruangan = old('ruangan', $this->pegawai->ruangan->nama_ruangan);
            $this->ruangan_id = old('ruangan', $this->pegawai->ruangan_id);
        }
        if ($this->kenaikan_pangkat != null) {
            $this->status_tipe = $this->kenaikan_pangkat->status_tipe;
            $this->pangkatGolongan =
                PangkatGolongan::all();
            $this->jabatan = old('jabatan', $this->kenaikan_pangkat->pegawai->jabatan);
            $this->pangkat_golongan_sebelumnya_id = $this->kenaikan_pangkat->pangkat_golongan_sebelumnya_id;
            $this->nama_pangkat_golongan_sebelumnya = $this->kenaikan_pangkat->pangkatGolonganSebelumnya->nama;
            $this->pangkat_golongan_id = $this->kenaikan_pangkat->pangkat_golongan_id;
            $this->ruangan = old('ruangan', $this->kenaikan_pangkat->pegawai->ruangan->nama_ruangan);
            $this->ruangan_id = old('ruangan', $this->kenaikan_pangkat->pegawai->ruangan_id);
        }
    }
    public function updatedPegawai($value)
    {
        $pegawai = Pegawai::find($value);
        if ($pegawai) {
            $this->status_tipe = $pegawai->status_tipe ?? 'pns';
            $this->resultGolongan = Golongan::where('jenis', $pegawai->status_tipe)->get();
            $this->resultPangkat = Pangkat::all();
            $this->pangkatGolongan = PangkatGolongan::where('jenis', $pegawai->status_tipe)->orderBy('nama', 'desc')->get();
            $this->jabatan = $pegawai->jabatan;
            $this->ruangan = $pegawai->ruangan->nama_ruangan;
            $this->ruangan_id = $pegawai->ruangan_id;
            $this->pangkat_golongan_sebelumnya_id = $pegawai->pangkat_golongan_id;
            $this->nama_pangkat_golongan_sebelumnya = $pegawai->pangkatGolongan->nama;
        }
    }

    public function updateId($data)
    {
        $this->pegawai = $data;
    }
    public function render()
    {
        return view('livewire.kenaikan-pangkat.jenis-pangkat-golongan');
    }
}
