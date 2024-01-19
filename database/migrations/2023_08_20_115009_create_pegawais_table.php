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
            $table->string('nik')->nullable()->unique();
            $table->string('nip_nippk')->nullable()->unique();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('nama_depan')->nullable();
            $table->string('nama_belakang')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('usia')->nullable();
            $table->string('agama')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('status_pegawai')->nullable();
            $table->unsignedBigInteger('ruangan_id')->nullable();
            $table->foreign('ruangan_id')->references('id')->on('ruangans');
            $table->string('tahun_pensiun')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('tanggal_lulus')->nullable();
            $table->string('no_ijazah')->nullable();
            $table->string('jabatan')->nullable();
            $table->integer('cuti_tahunan')->default(12)->nullable();
            $table->integer('tahun_cuti')->default(date('Y'));
            $table->integer('sisa_cuti_tahunan')->nullable();
            $table->string('masa_kerja')->nullable();
            $table->enum('status_tenaga', ['asn', 'non asn'])->nullable();
            $table->enum('status_tipe', ['pns', 'pppk', 'thl'])->nullable(); #tpe tenaga ini memasukkan apakah itu pns ppk atau non asn
            // asn
            $table->string('tmt_cpns')->nullable();
            $table->string('tmt_pns')->nullable();
            $table->string('tmt_pppk')->nullable();
            $table->string('tmt_pangkat_terakhir')->nullable();
            $table->unsignedBigInteger('pangkat_golongan_id')->nullable();
            $table->foreign('pangkat_golongan_id')->references('id')->on('pangkat_golongans');
            $table->string('sekolah')->nullable();
            $table->enum('jenis_tenaga', ['struktural', 'umum', 'nakes'])->nullable();
            // non asn
            $table->string('niPtt_pkThl')->nullable();
            $table->string('tanggal_masuk')->nullable();
            $table->timestamps();
            // asn umum
            $table->string('no_karpeg')->nullable();
            $table->string('no_taspen')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('pelatihan')->nullable();
            $table->string('password')->nullable();
            $table->string('status_nonaktif')->nullable();
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
