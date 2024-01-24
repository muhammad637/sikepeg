<?php

namespace App\Http\Livewire\SIP;

use Carbon\Carbon;
use App\Models\STR;
use Livewire\Component;

class SearchStr extends Component
{
    public $str;
    public $no_str;
    public $select;

    public function mount(){
        $this->no_str = old('no_str', null);
    }

    public function updatedSelect($value){
        // $str = ::where('');
        $saatIni = Carbon::parse(now())->format('Y-m-d');
        $str =  STR::where('pegawai_id', $value)->whereDate('masa_berakhir_str', '>=', $saatIni)->orderBy('masa_berakhir_str', 'desc')->first();
        if($str){
            $this->no_str = $str->no_str;
        }
    }
    public function render()
    {
        return view('livewire.s-i-p.search-str');
    }
}
