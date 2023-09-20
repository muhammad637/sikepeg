<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;


class PegawaiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pegawai([
            'nik' => $row[1],
            'nip_nippk' => $row[2],
            'gelar_depan' => $row[3],
            'gelar_belakang' => $row[4],
            'nama_depan' => $row[5],
            'nama_belakang' => $row[6],
            'jenis_kelamin' => $row[7],
            'tempat_lahir' => $row[8],
            'tanggal_lahir' => $row[9],
            'usia' => $row[10],
            'alamat' => $row[11],
            'agama' => $row[12],
            'no_wa' => $row[13],
            'status_pegawai' => $row[14],
            'ruangan' => $row[15],
            'tahun_pensiun' => $row[16],
            'status_tenaga' => $row[17],
            'pendidikan_terakhir' => $row[18],
            'tanggal_lulus' => $row[19],
            'no_ijazah' => $row[20],
            'tipe_tenaga' => $row[21],
            'jabatan' => $row[22],
            'cuti_tahunan' => $row[23],
            'masa_kerja' => $row[24],
            
            //
        ]);
    }
}
