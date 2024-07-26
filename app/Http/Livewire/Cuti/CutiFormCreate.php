<?php

namespace App\Http\Livewire\Cuti;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Pegawai;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\HariBesar;

class CutiFormCreate extends Component
{
    public $pegawai;
    public $no_hp;
    public $alamat;
    public $tanggal_saat_ini;
    public $tanggal_sebelumnya;
    public $status_tipe = 'pilih pegawai terlebih dahulu';
    public $jenis_cuti;
    public $alasan_cuti;
    public $mulai_cuti;
    public $status_cuti = 'pending';
    public $selesai_cuti;
    public $jumlah_hari;
    public $link_cuti;
    public $sisa_cuti_tahunan_saat_ini = 0;
    public $validasi_tanggal_cuti;

    public function mount()
    {
        $this->tanggal_saat_ini = Carbon::now()->format('Y-m-d');
        $this->tanggal_sebelumnya = Carbon::now()->subDays(11)->format('Y-m-d');
    }

    public function updatedMulaiCuti()
    {
        $this->calculateJumlahHariCuti();
        $this->validasi_tanggal_cuti = $this->mulai_cuti > $this->selesai_cuti;
    }

    public function updatedSelesaiCuti()
    {
        $this->calculateJumlahHariCuti();
        $this->validasi_tanggal_cuti = $this->mulai_cuti > $this->selesai_cuti;
    }

    public function updatedPegawai($value)
    {
        $pegawai = Pegawai::find($value);
        if ($pegawai) {
            $this->no_hp = $pegawai->no_wa;
            $this->alamat = $pegawai->alamat;
            $this->status_tipe = $pegawai->status_tipe;
            $this->sisa_cuti_tahunan_saat_ini = $pegawai->sisa_cuti_tahunan;
        }
    }

    private function calculateJumlahHariCuti()
    {
        $tahun = Carbon::now()->year;
        if ($this->mulai_cuti && $this->selesai_cuti) {
            $tanggalMulai = Carbon::parse($this->mulai_cuti);
            $tanggalSelesai = Carbon::parse($this->selesai_cuti);
            $hariBesar = HariBesar::whereYear('tanggal', $tahun)->pluck('tanggal')->toArray();
            $jumlahHariCuti = $this->hitungJumlahHariCuti($tanggalMulai, $tanggalSelesai, $hariBesar);
            $this->jumlah_hari = $jumlahHariCuti;
        }
    }

    private function hitungJumlahHariCuti($tanggalMulai, $tanggalSelesai, $hariBesar)
    {
        $jumlahHariCuti = 0;
        $period = CarbonPeriod::create($tanggalMulai, $tanggalSelesai);

        foreach ($period as $tanggal) {
            $tanggalString = $tanggal->format('Y-m-d');
            $isHariBesar = in_array($tanggalString, $hariBesar);

            if (!$isHariBesar) {
                $jumlahHariCuti++;
            }
        }

        return $jumlahHariCuti > 0 ? $jumlahHariCuti : 0;
    }

    public function save()
    {
        $this->validate([
            'pegawai' => 'required|exists:pegawais,id',
            'no_hp' => 'required',
            'alamat' => 'required',
            'jenis_cuti' => 'required',
            'alasan_cuti' => 'required',
            'mulai_cuti' => 'required|date|after_or_equal:tanggal_sebelumnya',
            'selesai_cuti' => 'required|date|after_or_equal:mulai_cuti',
            'jumlah_hari' => 'required|numeric|min:1',
            'link_cuti' => 'required|url',
        ]);

        Cuti::create([
            'pegawai_id' => $this->pegawai,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'jenis_cuti' => $this->jenis_cuti,
            'alasan_cuti' => $this->alasan_cuti,
            'mulai_cuti' => $this->mulai_cuti,
            'selesai_cuti' => $this->selesai_cuti,
            'jumlah_hari' => $this->jumlah_hari,
            'link_cuti' => $this->link_cuti,
            'status_cuti' => $this->status_cuti,
        ]);

        session()->flash('message', 'Data cuti berhasil disimpan.');
        return redirect()->route('admin.cuti.data-cuti-aktif.index');
    }

    public function render()
    {
        return view('livewire.cuti.cuti-form-create', [
            'pegawais' => Pegawai::all()
        ]);
    }
}
