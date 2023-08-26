<?php

namespace App\Http\Livewire\Pegawai;

use Livewire\Component;

class PangkatDanGolonganEdit extends Component
{
    public $pegawai;
    public $status_tenaga;
    // non_asn
    public $niPtt_pkThl;
    public $pendidikan_terakhir;
    public $tanggal_lulus;
    public $no_ijazah;
    public $jabatan_fungsional;
    public $tanggal_masuk;
    public $masa_kerja;
    public $cuti_tahunan;

    // asn
    public $tmt_cpns;
    public $tmt_pns;
    public $tmt_pangkat_terakhir;
    public $pangkat_golongan;
    public $sekolah;
    public $jabatan_struktural;

    // nakes
    public $no_str;
    public $tanggal_terbit_str;
    public $masa_berlaku_str;
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
    public $jenis_tenaga_struktural;

    public function mount()
    {

        $this->status_tenaga = session('status_tenaga', null);
        // non asn
        $this->niPtt_pkThl = old('niPtt_pkThl', null);
        $this->pendidikan_terakhir = old('pendidikan_terakhir', $this->pegawai->pendidikan_terakhir);
        $this->tanggal_lulus = old('tanggal_lulus', $this->pegawai->tanggal_lulus);
        $this->no_ijazah = old('no_ijazah', $this->pegawai->no_ijazah);
        $this->jabatan_fungsional = old('jabatan_fungsional', $this->pegawai->jabatan_fungsional);
        $this->tanggal_masuk = old('tanggal_masuk', null);
        $this->masa_kerja = old('masa_kerja', $this->pegawai->masa_kerja);
        $this->cuti_tahunan = old('cuti_tahunan', $this->pegawai->cuti_tahunan);
        // asn
        $this->tmt_cpns = old('tmt_cpns', null);
        $this->tmt_pns = old('tmt_pns', null);
        $this->tmt_pangkat_terakhir = old('tmt_pangkat_terakhir', null);
        $this->pangkat_golongan = old('pangkat_golongan', null);
        $this->sekolah = old('sekolah', null);
        $this->jabatan_struktural = old('jabatan_struktural', null);

        // umum
        $this->no_karpeg = old('no_karpeg', null);
        $this->no_taspen = old('no_taspen', null);
        $this->no_npwp = old('no_npwp', null);
        $this->no_hp = old('no_hp', null);
        $this->email = old('email', null);
        $this->pelatihan = old('pelatihan', null);

        $this->jenis_tenaga_struktural = session('jenis_tenaga_struktural', null);
        if (count($this->pegawai->non_asn) > 0) {
            $this->niPtt_pkThl = old('niPtt_pkThl', $this->pegawai->non_asn[0]->niPtt_pkThl);
            $this->tanggal_masuk = old('tanggal_masuk', $this->pegawai->non_asn[0]->tanggal_masuk);
        } elseif (count($this->pegawai->asn) > 0) {
            $this->tmt_cpns = old('tmt_cpns', $this->pegawai->asn[0]->tmt_cpns);
            $this->tmt_pns = old('tmt_pns', $this->pegawai->asn[0]->tmt_pns);
            $this->tmt_pangkat_terakhir = old('tmt_pangkat_terakhir', $this->pegawai->asn[0]->tmt_pangkat_terakhir ? $this->pegawai->asn[0]->tmt_pangkat_terakhir : null);
            $this->pangkat_golongan = old('pangkat_golongan', $this->pegawai->asn[0]->pangkat_golongan ? $this->pegawai->asn[0]->pangkat_golongan : null);
            $this->sekolah = old('sekolah', $this->pegawai->asn[0]->sekolah ? $this->pegawai->asn[0]->sekolah : null);
            $this->jabatan_struktural = old('jabatan_struktural', $this->pegawai->asn[0]->jabatan_struktural ? $this->pegawai->asn[0]->jabatan_struktural : null);
            $this->jenis_tenaga_struktural = old('jenis_tenaga_struktural', $this->pegawai->asn[0]->jenis_tenaga_struktural);
            if (count($this->pegawai->asn[0]->umum) > 0) {
                $this->no_karpeg = old('no_karpeg', $this->pegawai->asn[0]->umum[0]->no_karpeg);
                $this->no_taspen = old('no_taspen', $this->pegawai->asn[0]->umum[0]->no_taspen);
                $this->no_npwp = old('no_npwp', $this->pegawai->asn[0]->umum[0]->no_npwp);
                $this->no_hp = old('no_hp', $this->pegawai->asn[0]->umum[0]->no_hp);
                $this->email = old('email', $this->pegawai->asn[0]->umum[0]->email);
                $this->pelatihan = old('pelatihan', $this->pegawai->asn[0]->umum[0]->pelatihan);
            }
        }
        

    }
    public function updatedStatusTenaga($value)
    {
        $this->status_tenaga = $value;
        session(['status_tenaga' => $value]);
    }
    public function updatedJenisTenagaStruktural($value)
    {
        $this->jenis_tenaga_struktural = $value;
        session(['jenis_tenaga_struktural' => $value]);
    }

    public function render()
    {

        return view('livewire.pegawai.pangkat-dan-golongan-edit');
    }
}
