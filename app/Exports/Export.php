<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class Export implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $pegawai;
    public function __construct(array $pegawai)
    {
        $this->pegawai = $pegawai;
    }

    public function array(): array
    {
        return $this->pegawai;
    }
}
