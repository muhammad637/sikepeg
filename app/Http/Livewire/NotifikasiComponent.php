<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use App\Models\Pegawai;
use Livewire\Component;

class NotifikasiComponent extends Component
{
    public $notif = [];
    public function mount()
    {
        
        $notif = Admin::with(['notifikasi' => function ($q) {
            $q->orderBy('created_at', 'desc')->limit(3);
        }])->find(auth()->user()->id);
        // $notifikasis = $notif->notifikasis ??  [];
        $this->notif = $notif->notifikasi->count() > 0 ? $notif->notifikasi : [];
    }
    public function render()
    {
        return view('livewire.notifikasi-component');
    }
}
