<?php
namespace App\Http\Livewire\Cuti;

use Carbon\Carbon;
use App\Models\Pegawai;
use App\Models\Cuti;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\CarbonPeriod;
use App\Models\HariBesar;

class CutiFormEdit extends Component
{
    use WithFileUploads;

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
    // public $link_cuti;
    public $status_cuti;
    public $sisa_cuti_tahunan_saat_ini;
    public $sisa_cuti_tahunan_setelah_diubah = 0;
    public $tanggal_saat_ini;
    public $tanggal_sebelumnya;

    public function mount($cuti)
    {
        $this->tanggal_saat_ini = Carbon::now()->format('Y-m-d');
        $this->tanggal_sebelumnya = Carbon::now()->subDays(11)->format('Y-m-d');

        if ($cuti) {
            $this->cuti = $cuti;
            $this->status_cuti = $cuti->status_cuti ?? 'pending';
            $this->jenis_cuti = old('jenis_cuti', $cuti->jenis_cuti);
            $this->alasan_cuti = old('alasan_cuti', $cuti->alasan_cuti);
            $this->mulai_cuti = old('mulai_cuti', $cuti->mulai_cuti);
            $this->selesai_cuti = old('selesai_cuti', $cuti->selesai_cuti);
            $this->jumlah_hari = old('jumlah_hari', $cuti->jumlah_hari);
            // $this->link_cuti = old('link_cuti', $cuti->link_cuti);
            $pegawai = Pegawai::find($cuti->pegawai_id);
        } else {
            $pegawai = Pegawai::find($this->pegawai);
        }

        if ($pegawai) {
            $this->status_tipe = old('status_tipe', $pegawai->status_tipe);
            $this->sisa_cuti_tahunan_saat_ini = $pegawai->sisa_cuti_tahunan;
            $this->no_hp = old('no_hp', $pegawai->no_wa);
            $this->alamat = old('alamat', $pegawai->alamat);
            // $this->link_cuti = old('link_cuti', $pegawai->link_cuti);
        }
    }

    public function updatedMulaiCuti()
    {
        $this->updateJumlahHariCuti();
    }

    public function updatedSelesaiCuti()
    {
        $this->updateJumlahHariCuti();
    }

    public function updatedPegawai($value)
    {
        $pegawai = Pegawai::find($value);
        if ($pegawai) {
            $this->no_hp = $pegawai->no_wa;
            $this->alamat = $pegawai->alamat;
            $this->status_tipe = $pegawai->status_tipe;
            $this->status_cuti = $pegawai->status_cuti;
            $this->sisa_cuti_tahunan_saat_ini = $pegawai->sisa_cuti_tahunan;
            // $this->link_cuti = $pegawai->link_cuti;
        }
    }

    private function updateJumlahHariCuti()
    {
        $tahun = Carbon::now()->format('Y');

        if ($this->mulai_cuti && $this->selesai_cuti) {
            $tanggalMulai = Carbon::parse($this->mulai_cuti);
            $tanggalSelesai = Carbon::parse($this->selesai_cuti);
            $hariBesar = HariBesar::whereYear('tanggal', $tahun)->pluck('tanggal')->toArray();

            $this->jumlah_hari = $this->hitungJumlahHariCuti($tanggalMulai, $tanggalSelesai, $hariBesar);
        }
    }

    private function hitungJumlahHariCuti($tanggalMulai, $tanggalSelesai, $hariBesar)
    {
        $jumlahHariCuti = 0;
        $period = CarbonPeriod::create($tanggalMulai, $tanggalSelesai);
        foreach ($period as $tanggal) {
            $tanggalString = $tanggal->format('Y-m-d');
            if (!in_array($tanggalString, $hariBesar)) {
                $jumlahHariCuti++;
            }
        }
        return max($jumlahHariCuti, 0);
    }

    public function save()
    {
        $this->validate([
         
            'jenis_cuti' => 'required|string',
            'alasan_cuti' => 'required|string',
            'mulai_cuti' => 'required|date',
            'selesai_cuti' => 'required|date',
            'jumlah_hari' => 'required|integer|min:1',
            'status_cuti' => 'required|string|in:pending,disetujui,ditolak',
            // 'link_cuti' => 'file|max:1024', // 1MB Max
        ]);

        $cuti = Cuti::find($this->cuti->id);
        $cuti->status_cuti = $this->status_cuti;
        $cuti->jenis_cuti = $this->jenis_cuti;
        $cuti->alasan_cuti = $this->alasan_cuti;
        $cuti->mulai_cuti = $this->mulai_cuti;
        $cuti->selesai_cuti = $this->selesai_cuti;
        $cuti->jumlah_hari = $this->jumlah_hari;

        // if ($this->link_cuti) {
        //     $cuti->link_cuti = $this->link_cuti->store('cuti_files');
        // }
        // $path = $this->link_cuti->store('cuti', 's3');

        $cuti->save();

        session()->flash('message', 'Status cuti berhasil diperbarui.');
        return redirect()->route('admin.cuti.data-cuti-aktif.index'); // Adjust the route as needed
    }

    public function render()
    {
        return view('livewire.cuti.cuti-form-edit');
    }
}
