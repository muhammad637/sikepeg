<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PegawaiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        if($row['nik'] !== null){
            return new Pegawai([
                'nik' => $row['nik'],
                'nip_nippk' => $row['nip_nippk'],
                'gelar_depan' => $row['gelar_depan'],
                'gelar_belakang' => $row['gelar_belakang'],
                'nama_depan' => $row['nama_depan'],
                'nama_belakang' => $row['nama_belakang'],
                'nama_lengkap' => $row['gelar_depan']. ' '. $row['nama_depan'] .' ' . $row['nama_belakang'] . ' ' . $row['gelar_belakang'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'tempat_lahir' => $row['tempat_lahir'],
                'tanggal_lahir' => Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d'),
                'usia' => $row['usia'],
                'alamat' => $row['alamat'],
                'agama' => $row['agama'],
                'no_wa' => $row['no_wa'],
                'status_pegawai' => $row['status_pegawai'],
                'ruangan' => $row['ruangan'],
                'tahun_pensiun' => $row['tahun_pensiun'],
                'status_tenaga' => $row['status_tenaga'],
                'pendidikan_terakhir' => $row['pendidikan_terakhir'],
                'tanggal_lulus' =>  Date::excelToDateTimeObject($row['tanggal_lulus'])->format('Y-m-d'),
                'no_ijazah' => $row['no_ijazah'],
                'status_tipe' => $row['status_tipe'],
                'jabatan' => $row['jabatan'],
                'cuti_tahunan' => $row['cuti_tahunan'] ?? 12,
                'masa_kerja' => $row['masa_kerja'],
                //
            ]);
        }

        return null;
    }
}
