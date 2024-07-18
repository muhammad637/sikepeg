<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use App\Models\Notifikasi;
use App\Models\Pegawai;
use Livewire\Component;

class NotifikasiComponent extends Component
{
    public $notif = [];
    public function mount()
    {
    //   $notif = auth()->user()->notifikasi ? auth()->user()->notifikasi->sortByDesc('created_at')->take(3) : null;  
      $notif = auth()->user()->notifikasi->sortByDesc('created_at')->take(3);  
        // $notif = Admin::with(['notifikasi' => function ($q) {
        //     $q->orderBy('created_at', 'desc')->limit(3);
        // }])->find(auth()->user()->id);
        // $notifikasis = $notif->notifikasis ??  [];
        $this->notif = $notif->count() > 0 ? $notif : [];
    }
    public function render()
    {
        return view('livewire.notifikasi-component');
    }
}
