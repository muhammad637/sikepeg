<?php

namespace App\Http\Livewire\Pegawai;

use App\Models\Ruangan;
use Livewire\Component;

class RuanganId extends Component
{
    public $ruangan_id;
    public $ruangans = [];
    public $nama_ruangan;
    public $pegawai;

    public function mount()
    {
        // Mengambil data ruangan dari database dan diurutkan berdasarkan nama_ruangan secara ascending
        $this->ruangans = Ruangan::orderBy('nama_ruangan', 'asc')->get();
        // Menginisialisasi nilai $ruangan_id dengan nilai dari input lama atau nilai default
        $this->ruangan_id = old('ruangan_id', $this->ruangan_id);
        // Menginisialisasi nilai $nama_ruangan dengan nilai dari input lama atau null jika tidak ada
        $this->nama_ruangan = old('nama_ruangan', null);
    }
    public function render()
    {
        // Menampilkan view 'livewire.pegawai.ruangan-id'
        return view('livewire.pegawai.ruangan-id');
    }
}
