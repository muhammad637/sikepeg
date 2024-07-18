<?php

namespace App\Http\Livewire;

use App\Models\Pegawai;
use Livewire\Component;

class NotifikasiPegawaiComponent extends Component
{
    public $notif = [];
    public function mount(){
        // $notif = Pegawai::with(['notifikasi' => function ($q) {
        //     $q->orderBy('created_at', 'desc')->limit(3);
        // }])->find(auth()->user()->id);
        $notif = auth()->guard('pegawai')->user()->notifikasi->sortByDesc('created_at')->take(3);
        $notifikasis = $notif ??  [];
        $this->notif = $notifikasis;
    }
    public function render()
    {
        return view('livewire.notifikasi-pegawai-component');
    }
}
