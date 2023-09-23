<?php

namespace App\Http\Livewire\Cuti;

use App\Models\Pegawai;
use Livewire\Component;

class CutiFormCreate extends Component
{
    public $pegawai;
    public $status_tipe;
    public $jenis_cuti;
    public $alasan_cuti;
    public $mulai_cuti;
    public $selesai_cuti;
    public $jumlah_hari;

    public function updatedPegawai($value){
        $pegawai = Pegawai::find($value);
        $this->status_tipe = $pegawai->status_tipe;
    }
    public function render()
    {
        return view('livewire.cuti.cuti-form-create',[
            'result' => Pegawai::all()
        ]);
    }
}
