<?php

namespace App\Http\Livewire\STR;

use Carbon\Carbon;
use App\Models\SIP;
use Livewire\Component;

class SearchSip extends Component
{
    public $sip;
    public $no_sip;
    public $select;

    public function mount(){
        $this->no_sip = old('no_sip', null);
    }

    public function updatedSelect($value){
        // $str = ::where('');
        $saatIni = Carbon::parse(now())->format('Y-m-d');
        $sip =  SIP::where('pegawai_id', $value)->whereDate('masa_berakhir_sip', '>=', $saatIni)->orderBy('masa_berakhir_sip', 'desc')->first();
        if($sip){
            $this->no_sip = $sip->no_sip;
        }
    }
    public function render()
    {
        return view('livewire.s-t-r.search-sip');
    }
}
