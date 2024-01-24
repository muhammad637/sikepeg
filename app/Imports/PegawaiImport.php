<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Golongan;
use App\Models\PangkatGolongan;
use Illuminate\Support\Facades\Hash;
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
        // $tanggal_lahir= Date::excelToDateTimeObject($row['tgl_lulus'])->format('Y-m-d');
        // dd($row);
        $pangkatDefault = 'juru muda';
        $ruangan = Ruangan::firstOrCreate(['nama_ruangan' => strtolower($row['nama_ruangan'])]);
        // $pangkat_golongan = PangkatGolongan::firstOrCreate(['nama_ruangan' => strtolower($row['nama_ruangan'])]);

        // $ruangan = Ruangan::firstOrCreate(['nama_ruangan' => strtolower($row['nama_ruangan'])]);
        if (strtolower($row['status_tipe']) == 'pns' || strtolower($row['status_tipe']) == 'pppk') {
            // Jika status adalah ASN, tambahkan juga pangkat dan golongan
            $pangkat_golongan =
                PangkatGolongan::firstOrCreate(
                    [
                        'nama_kecil' => strtolower($row['pangkat_golongan']),
                        'nama' => $row['pangkat_golongan'],
                        'jenis' => strtolower($row['status_tipe'])
                    ]
                );
        }
        if ($row['nik'] !== null) {
            // dd($row);
            // dd(Date::excelToDateTimeObject($row['tmt_pppk'])->format('Y-m-d'));
            $pegawai = new Pegawai([
                'nik' => $row['nik'],
                'nip_nippk' => $row['nipnippk'],
                'niPtt_pkThl' => $row['ni_ppt_pkthl'] ?? null,
                'gelar_depan' => $row['gelar_depan'],
                'nama_depan' => $row['nama_depan'],
                'nama_belakang' => $row['nama_belakang'],
                'gelar_belakang' => $row['gelar_belakang'],
                'nama_lengkap' => $row['gelar_depan'] . ' ' . $row['nama_depan'] . ' ' . $row['nama_belakang'] . ' ' . $row['gelar_belakang'],
                'jenis_kelamin' => strtolower($row['jenis_kel']),
                'tempat_lahir' => $row['tempat_lahir'],
                'tanggal_lahir' =>   Date::excelToDateTimeObject($row['tgl_lahir'])->format('Y-m-d'),
                'usia' => $row['usia'] ?? null,
                'alamat' => $row['alamat'],
                'agama' => $row['agama'],
                'no_wa' => $row['no_wa'],
                'status_pegawai' => strtolower($row['status_pegawai']),
                'tahun_pensiun' => $row['thn_pensiun'],
                'status_tenaga' => strtolower($row['status_tenaga']),
                'pendidikan_terakhir' => isset($row['pend_sesuai_sk_terakhir']) ? $row['pend_sesuai_sk_terakhir'] : $row['pend_terakhir'],
                'tanggal_lulus' =>  Date::excelToDateTimeObject($row['tgl_lulus'])->format('Y-m-d'),
                'no_ijazah' => $row['no_ijazah'],
                'status_tipe' => strtolower($row['status_tipe']),
                'jabatan' => $row['jabatan'],
                'cuti_tahunan' => $row['cuti_tahunan'] ?? 12,
                'sisa_cuti_tahunan' => $row['cuti_tahunan'] ?? 12,
                'masa_kerja' => $row['masa_kerja'] ?? null,
                'jenis_tenaga' => isset($row['jns_tenaga']) ? strtolower($row['jns_tenaga']) : null,
                'tanggal_masuk' => isset($row['tgl_masuk']) ? Date::excelToDateTimeObject($row['tgl_masuk'])->format('Y-m-d') : null,

                'sekolah' => isset($row['sekolah_perguruan_tinggi']) ? $row['sekolah_perguruan_tinggi'] : null,
                'tmt_cpns' => isset($row['tmt_cpns'])  ? Date::excelToDateTimeObject($row['tmt_cpns'])->format('Y-m-d') : null,
                'tmt_pns' => isset($row['tmt_pns']) ? Date::excelToDateTimeObject($row['tmt_pns'])->format('Y-m-d') : null,
                'tmt_pangkat_terakhir' => isset($row['tmt_pangkat_terakhir']) ? Date::excelToDateTimeObject($row['tmt_pangkat_terakhir'])->format('Y-m-d') : null,
                'tmt_pppk' => isset($row['tmt_pppk']) ? Date::excelToDateTimeObject($row['tmt_pppk'])->format('Y-m-d') : null,
                'password' =>  Hash::make(Date::excelToDateTimeObject($row['tgl_lahir'])->format('dmY')),
                'ruangan_id' => $ruangan->id,
                'pangkat_golongan_id' => $pangkat_golongan->id ?? null,

            ]);
            return $pegawai;
        }
        return null;
    }
}
