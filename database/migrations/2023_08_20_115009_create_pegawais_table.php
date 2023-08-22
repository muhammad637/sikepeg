<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('gelar_depan');
            $table->string('gelar_belakang');
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('usia');
            $table->string('alamat');
            $table->string('agama');
            $table->string('no_wa');
            $table->string('status_pegawai');
            $table->string('ruangan');
            $table->string('tahun_pensiun');
            $table->string('status_tenaga');
            // asn
            $table->string('tmt_cpns')->nullable();
            $table->string('tmt_pns')->nullable();
            $table->string('tmt_pangkat_terakhir')->nullable();
            $table->string('pangkat_golongan')->nullable();
            $table->string('pendidikan_terakhir');
            $table->string('tanggal_lulus');
            $table->string('sekolah')->nullable();
            $table->string('no_ijazah');
            $table->string('jenis_tenaga')->nullable();
            $table->string('jabatan_struktural')->nullable();
            $table->string('jabatan_fungsional')->nullable();
            // asn -> umum
            $table->string('no_karpeg')->nullable();
            $table->string('no_taspen')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('pelatihan')->nullable();
            // non Asni
            $table->string('nipkk')->nullable();
            $table->string('niPtt_pk/thl')->nullable();
            $table->string('cuti_tahunan')->nullabel();

            $table->int('cuti_tahunan')->nullable();
            $table->int('cuti_sakit')->nullabel();
            $table->int('cuti_karena_alasan_penting')->nullable();
            $table->int('cuti_besar')->nullabel();
            $table->int('cuti_melahirkan')->nullabel();
            $table->int('cuti_di_luar_tanggungan_negara')->nullabel();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
};
