<?php

namespace App\Exports;

use App\Models\SIP;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;




class SIPExport implements FromArray
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
