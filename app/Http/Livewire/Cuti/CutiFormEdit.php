<?php

namespace App\Http\Livewire\Cuti;

use Carbon\Carbon;
use App\Models\Pegawai;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\HariBesar;

class CutiFormEdit extends Component
{
    public $result;
    public $cuti;
    public $no_hp;
    public $alamat;
    public $pegawai;
    public $status_tipe;
    public $jenis_cuti;
    public $alasan_cuti;
    public $mulai_cuti;
    public $selesai_cuti;
    public $jumlah_hari;
    public $link_cuti;
    public $sisa_cuti_tahunan_saat_ini;
    public $sisa_cuti_tahunan_setelah_diubah = 0;
    public $tanggal_saat_ini;
    public $tanggal_sebelumnya;
    public function mount()
    {
        $this->tanggal_saat_ini = Carbon::parse(now())->format('Y-m-d');
        $this->tanggal_sebelumnya = Carbon::parse(now())->subDays(11)->format('Y-m-d');
        $pegawai = Pegawai::find($this->pegawai);
        if ($pegawai) {
            $this->status_tipe = old('status_tipe', $pegawai->status_tipe);
            $this->sisa_cuti_tahunan_saat_ini = $pegawai->sisa_cuti_tahunan;
            $this->no_hp = old('no_hp', $pegawai->no_wa);
            $this->alamat = old('alamat', $pegawai->alamat);
        }
        $this->jenis_cuti = old('jenis_cuti', $this->cuti['jenis_cuti']);
        $this->alasan_cuti = old('alasan_cuti', $this->cuti['alasan_cuti']);
        $this->mulai_cuti = old('mulai_cuti', $this->cuti['mulai_cuti']);
        $this->selesai_cuti = old('selesai_cuti', $this->cuti['selesai_cuti']);
        $this->jumlah_hari = old('jumlah_hari', $this->cuti['jumlah_hari']);
        $this->link_cuti = old('link_cuti', $this->cuti['link_cuti']);
    }
    public function updatedMulaiCuti()
    {
        $tahun = Carbon::parse(now())->format('Y');

        if ($this->mulai_cuti != null && $this->selesai_cuti != null) {
            // Contoh penggunaan
            $tanggalMulai = Carbon::parse($this->mulai_cuti);
            $tanggalSelesai = Carbon::parse($this->selesai_cuti);
            $hariBesar = HariBesar::whereYear('tanggal', $tahun)->pluck('tanggal')->toArray();
            // $hariBesar = HariBesar::all()->; // Tanggal Hari Natal sebagai contoh hari besar    
            $jumlahHariCuti = $this->hitungJumlahHariCuti($tanggalMulai, $tanggalSelesai, $hariBesar);
            $this->jumlah_hari = $jumlahHariCuti;
        }
    }
    public function updatedSelesaiCuti()
    {
        $tahun = Carbon::parse(now())->format('Y');
        if ($this->mulai_cuti != null && $this->selesai_cuti != null) {
            // Contoh penggunaan
            $tanggalMulai = Carbon::parse($this->mulai_cuti);
            $tanggalSelesai = Carbon::parse($this->selesai_cuti);
            $hariBesar = HariBesar::whereYear('tanggal', $tahun)->pluck('tanggal')->toArray();
            // $hariBesar = HariBesar::all()->; // Tanggal Hari Natal sebagai contoh hari besar    
            $jumlahHariCuti = $this->hitungJumlahHariCuti($tanggalMulai, $tanggalSelesai, $hariBesar);
            $this->jumlah_hari = $jumlahHariCuti;
        }
    }

    public function updatedPegawai($value)
    {
        $pegawai = Pegawai::find($value);
        $this->no_hp = $pegawai->no_wa;
        $this->alamat = $pegawai->alamat;
        $this->status_tipe = $pegawai->status_tipe;
        $this->sisa_cuti_tahunan_saat_ini = $pegawai->sisa_cuti_tahunan;
    }

    function hitungJumlahHariCuti($tanggalMulai, $tanggalSelesai, $hariBesar)
    {
        $jumlahHariCuti = 0;

        // Buat rentang tanggal antara tanggal mulai dan tanggal selesai
        $period = CarbonPeriod::create($tanggalMulai, $tanggalSelesai);

        foreach ($period as $tanggal) {
            // Periksa apakah tanggal saat ini adalah hari besar
            $tanggalString = $tanggal->format('Y-m-d');
            $isHariBesar = in_array($tanggalString, $hariBesar);

            // Jika bukan hari besar, tambahkan satu ke jumlah hari cuti
            if (!$isHariBesar) {
                $jumlahHariCuti++;
            }
        }
        if ($jumlahHariCuti <= 0) {
            return 0;
        }

        return $jumlahHariCuti;
    }
    public function render()
    {
        return view('livewire.cuti.cuti-form-edit',);
    }
}
