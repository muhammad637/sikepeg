<?php

namespace App\Exports;

use App\Models\STR;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

// class STRExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     protected $str;
//     public function __construct(array $orders)
//     {
//         $this->s = $orders;       
//     }

//     public function array() :array {
//         return $this->orders;
//     }
// }


class STRExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $pegawai;
    public function __construct(array $pegawai)
    {
        $this->pegawai = $pegawai;       
    }

    public function array() :array {
        return $this->pegawai;
    }
}
