<?php

namespace App\Http\Livewire\Pegawai;

use App\Models\Pangkat;
use Livewire\Component;
use App\Models\Golongan;
use App\Models\PangkatGolongan;

class PangkatDanGolongan extends Component
{
    public $status_tenaga;
    public $status_tipe;
    // non_asn
    public $niPtt_pkThl;
    public $pendidikan_terakhir;
    public $tanggal_lulus;
    public $no_ijazah;
    public $jabatan;
    public $tanggal_masuk;
    public $masa_kerja;
    public $cuti_tahunan = '12';

    // asn
    public $tmt_cpns;
    public $tmt_pns;
    public $tmt_pppk;
    public $tmt_pangkat_terakhir;


    public $sekolah;
    public $jenis_tenaga;
    public $pangkat_golongan_id;
    public $pangkat_golongan = [];
    public $nama_pangkat_golongan;

    // nakes
    public $no_str;
    public $tanggal_terbit_str;
    public $masa_berakhir_str;
    public $no_sip;
    public $tanggal_terbit_sip;
    public $masa_berlaku_sip;
    public $link_str;
    public $link_sip;

    // umum
    public $no_karpeg;
    public $no_taspen;
    public $no_npwp;
    public $no_hp;
    public $email;
    public $pelatihan;

    public function mount()
    {
        $this->status_tenaga = old('status_tenaga', null);
        // non asn
        $this->niPtt_pkThl = old('niPtt_pkThl', null);
        $this->pendidikan_terakhir = old('pendidikan_terakhir', null);
        $this->tanggal_lulus = old('tanggal_lulus', null);
        $this->no_ijazah = old('no_ijazah', null);
        $this->jabatan = old('jabatan', null);
        $this->tanggal_masuk = old('tanggal_masuk', null);
        $this->masa_kerja = old('masa_kerja', null);
        $this->cuti_tahunan = old('cuti_tahunan', 12);
        // asn
        $this->tmt_cpns = old('tmt_cpns', null);
        $this->status_tipe = old('status_tipe', null);
        $this->tmt_pns = old('tmt_pns', null);
        $this->tmt_pppk = old('tmt_pppk', null);
        $this->tmt_pangkat_terakhir = old('tmt_pangkat_terakhir', null);
        $this->status_tipe = old('status_tipe', null);
        if ($this->status_tipe == 'pns' || $this->status_tipe == 'pppk') {
            $this->pangkat_golongan = PangkatGolongan::where('jenis', $this->status_tipe)->get();
        }
        $this->pangkat_golongan_id = old('pangkat_golongan_id', null);
        $this->nama_pangkat_golongan = old('nama_pangkat_golongan', null);

        $this->sekolah = old('sekolah', null);
        // nakes
        $this->tanggal_terbit_str = old('tanggal_terbit_str', null);
        $this->masa_berakhir_str = old('masa_berakhir_str', null);
        $this->link_str = old('link_str', null);
        $this->no_str = old('no_str', null);
        $this->tanggal_terbit_sip = old('tanggal_terbit_sip', null);
        $this->masa_berlaku_sip = old('masa_berlaku_sip', null);
        $this->link_sip = old('link_sip', null);
        $this->no_sip = old('no_sip', null);
        // umum
        $this->no_karpeg = old('no_karpeg', null);
        $this->no_taspen = old('no_taspen', null);
        $this->no_npwp = old('no_npwp', null);
        $this->no_hp = old('no_hp', null);
        $this->email = old('email', null);
        $this->pelatihan = old('pelatihan', null);
        $this->jenis_tenaga = old('jenis_tenaga', null);
    }
    public function updatedStatusTenaga($value)
    {
        // $this->status_tenaga = $value;
        if ($this->status_tenaga == 'non asn') {
            $this->status_tipe = 'non asn';
        }
        // old(['status_tenaga' => $value]);
    }
    public function updatedStatusTipe($value)
    {
        $this->pangkat_golongan = PangkatGolongan::where('jenis', $value)->get();
    }
    public function updatedJenisTenagaStruktural($value)
    {
        $this->jenis_tenaga = $value;
        // old(['jenis_tenaga' => $value]);
    }
    public function render()
    {
        return view('livewire.pegawai.pangkat-dan-golongan');
    }
}
