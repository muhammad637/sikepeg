<?php

namespace App\Http\Livewire\Mutasi;

use App\Models\mutasi;
use App\Models\Pegawai;
use App\Models\Ruangan;
use Livewire\Component;

class JenisMutasiEdit extends Component
{
    public $mutasi;
    public $jenis_mutasi;
    public $ruangans;
    public $ruangan_awal_id;
    public $ruangan_tujuan_id;
    public $tanggal_berlaku;
    public $no_sk;
    public $tanggal_sk;
    public $select_pegawai;
    public $link_sk;
    //eksternal
    public $instansi_awal;
    public $instansi_tujuan;


    public function mount()
    {

        $this->jenis_mutasi = old('jenis_mutasi', $this->mutasi->jenis_mutasi);
        $this->ruangan_awal_id = old('ruangan_awal_id', $this->mutasi->ruangan_awal_id ?? null);
        $this->ruangan_tujuan_id = old('ruangan_tujuan_id', $this->mutasi->ruangan_tujuan_id ?? null);
        $this->tanggal_berlaku = old('tanggal_berlaku', $this->mutasi->tanggal_berlaku ?? null);
        $this->no_sk = old('no_sk', $this->mutasi->no_sk ?? null);
        $this->tanggal_sk = old('tanggal_sk', $this->mutasi->tanggal_sk ?? null);
        $this->instansi_awal = old('instansi_awal', $this->mutasi->instansi_awal ?? null);
        $this->instansi_tujuan = old('instansi_tujuan', $this->mutasi->instansi_tujuan ?? null);
        $this->link_sk = old('link_sk', $this->mutasi->link_sk ?? null);
        $this->ruangans = Ruangan::orderBy('nama_ruangan', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.mutasi.jenis-mutasi-edit');
    }
}
