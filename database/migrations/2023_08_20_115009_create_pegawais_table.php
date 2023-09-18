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
            $table->string('nik')->nullable();
            $table->string('nip_nippk')->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('nama_depan')->nullable();
            $table->string('nama_belakang')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('usia')->nullable();
            $table->string('alamat')->nullable();
            $table->string('agama')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('status_pegawai')->nullable();
            $table->string('ruangan')->nullable();
            $table->string('tahun_pensiun')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('tanggal_lulus')->nullable();
            $table->string('no_ijazah')->nullable();
            $table->string('jabatan')->nullable();
            $table->integer('cuti_tahunan')->default(12)->nullable();
            $table->integer('sisa_cuti_tahunan')->nullable();
            $table->string('masa_kerja')->nullable();
            $table->enum('status_tenaga', ['asn', 'non asn'])->nullable();
            $table->enum('status_tipe', ['pns', 'pppk', 'non asn'])->nullable(); #tpe tenaga ini memasukkan apakah itu pns ppk atau non asn
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
