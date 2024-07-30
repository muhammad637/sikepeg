<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiklatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diklats')->insert([
            [
                'pegawai_id' => 1, // Sesuaikan dengan ID yang ada di tabel 'pegawais'
                'ruangan_id' => 1, // Sesuaikan dengan ID yang ada di tabel 'ruangans'
                'nama_diklat' => 'Pelatihan Laravel',
                'link_pengajuan_diklat' => 'http://example.com/pengajuan-laravel',
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-08-05',
                'jumlah_hari' => 5,
                'jumlah_jam' => 40,
                'penyelenggara' => 'PT Teknologi',
                'tempat' => 'Jakarta',
                'tahun' => '2024',
                'no_sertifikat' => '123456789',
                'tanggal_sertifikat' => '2024-08-06',
                'link_sertifikat' => 'http://example.com/sertifikat-laravel',
                'status_diklat' => 'diterima',
            ],
            [
                'pegawai_id' => 2,
                'ruangan_id' => 2,
                'nama_diklat' => 'Flutter Workshop',
                'link_pengajuan_diklat' => 'http://example.com/pengajuan-flutter',
                'tanggal_mulai' => '2024-09-10',
                'tanggal_selesai' => '2024-09-12',
                'jumlah_hari' => 3,
                'jumlah_jam' => 24,
                'penyelenggara' => 'PT Digital',
                'tempat' => 'Bandung',
                'tahun' => '2024',
                'no_sertifikat' => '987654321',
                'tanggal_sertifikat' => '2024-09-13',
                'link_sertifikat' => 'http://example.com/sertifikat-flutter',
                'status_diklat' => 'pending',
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ]);
    }
}
