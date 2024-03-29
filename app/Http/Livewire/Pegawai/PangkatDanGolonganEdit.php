<?php

namespace App\Http\Livewire\Pegawai;

use Carbon\Carbon;
use App\Models\Pangkat;
use Livewire\Component;
use App\Models\Golongan;
use App\Models\PangkatGolongan;

class PangkatDanGolonganEdit extends Component
{
    public $pegawai;
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
    public $cuti_tahunan;

    // asn
    public $tmt_cpns;
    public $tmt_pns;
    public $tmt_pppk;
    public $tmt_pangkat_terakhir;
    // public $pangkats = []; #pns saja
    // public $pangkat_id; #pns saja
    // public $nama_pangkat;
    // public $golongans = []; #pns atau pppk
    // public $golongan_id; #pns atau pppk
    // public $nama_golongan;
    public $pangkat_golongan_id;
    public $pangkat_golongan = [];
    public $nama_pangkat_golongan;
    // public $pangkat_golongan;
    public $sekolah;
    // public $jabatan;

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
    public $jenis_tenaga;


    public $datas;

    public function mount()
    {
        // $this->pangkat_golongan_id = $this->pegawai->pangkat_golongan_id;
        $this->status_tenaga = old('status_tenaga', $this->pegawai->status_tenaga);
        $this->status_tipe = old('status_tipe', $this->pegawai->status_tipe);
        // non asn
        $this->niPtt_pkThl = old('niPtt_pkThl', null);
        $this->pendidikan_terakhir = old('pendidikan_terakhir', $this->pegawai->pendidikan_terakhir);
        $this->tanggal_lulus = old('tanggal_lulus', $this->pegawai->tanggal_lulus);
        $this->no_ijazah = old('no_ijazah', $this->pegawai->no_ijazah);
        $this->jabatan = old('jabatan', $this->pegawai->jabatan);
        $this->tanggal_masuk = old('tanggal_masuk', null);
        $this->masa_kerja = old('masa_kerja', $this->pegawai->masa_kerja);
        $this->cuti_tahunan = old('cuti_tahunan', $this->pegawai->cuti_tahunan);
        // asn
        $this->tmt_cpns = old('tmt_cpns', null);
        $this->tmt_pns = old('tmt_pns', null);
        $this->tmt_pppk = old('tmt_pppk', null);
        $this->tmt_pangkat_terakhir = old('tmt_pangkat_terakhir', null);
        // $this->nama_pangkat = old('nama_pangkat',null);
        // $this->nama_golongan = old('nama_golongan', null);
        $this->sekolah = old('sekolah', null);

        // umum
        $this->no_karpeg = old('no_karpeg', null);
        $this->no_taspen = old('no_taspen', null);
        $this->no_npwp = old('no_npwp', null);
        $this->no_hp = old('no_hp', null);
        $this->email = old('email', null);
        $this->pelatihan = old('pelatihan', null);
        $this->jenis_tenaga = old('jenis_tenaga', null);
        if ($this->pegawai->status_tenaga == 'non asn') {
            $this->niPtt_pkThl = old('niPtt_pkThl', $this->pegawai->niPtt_pkThl);
            $this->tanggal_masuk = old('tanggal_masuk', $this->pegawai->tanggal_masuk);
        } elseif ($this->pegawai->status_tenaga == 'asn') {
            $this->tmt_cpns = old('tmt_cpns', $this->pegawai->tmt_cpns);
            $this->status_tipe = old('status_tipe', $this->pegawai->status_tipe);
            $this->tmt_pns = old('tmt_pns', $this->pegawai->tmt_pns);
            $this->tmt_pangkat_terakhir = old('tmt_pangkat_terakhir', $this->pegawai->tmt_pangkat_terakhir);
            $this->tmt_pppk = old('tmt_pppk', $this->pegawai->tmt_pppk ?? null);
            if ($this->status_tipe == 'pns' || $this->status_tipe == 'pppk') {
                $this->pangkat_golongan = PangkatGolongan::where('jenis', $this->status_tipe)->get();
                $this->pangkat_golongan_id = old('pangkat_golongan_id', $this->pegawai->pangkat_golongan_id);
                $this->nama_pangkat_golongan = old('nama_pangkat_golongan', null);
            }
            

            $this->sekolah = old('sekolah', $this->pegawai->sekolah);
            $this->jenis_tenaga = old('jenis_tenaga', $this->pegawai->jenis_tenaga);
            if ($this->jenis_tenaga == 'umum' || $this->jenis_tenaga == 'struktural') {
                $this->no_karpeg = old('no_karpeg', $this->pegawai->no_karpeg);
                $this->no_taspen = old('no_taspen', $this->pegawai->no_taspen);
                $this->no_npwp = old('no_npwp', $this->pegawai->no_npwp);
                $this->no_hp = old('no_hp', $this->pegawai->no_hp);
                $this->email = old('email', $this->pegawai->email);
                $this->pelatihan = old('pelatihan', $this->pegawai->pelatihan);
            }
        }
    }
    public function updatedStatusTipe($value)
    {
        $this->pangkat_golongan = PangkatGolongan::where('jenis', $this->status_tipe)->get();
      
    }

    public function updatedJenisTenagaStruktural($value)
    {
        $this->jenis_tenaga = $value;
        session(['jenis_tenaga' => $value]);
    }



    public function render()
    {
        return view('livewire.pegawai.pangkat-dan-golongan-edit');
    }
}
