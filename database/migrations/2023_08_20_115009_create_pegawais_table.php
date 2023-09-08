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
            $table->string('nip_nippk');
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('nama_depan');
            $table->string('nama_belakang')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('usia')->nullable();
            $table->string('alamat');
            $table->string('agama');
            $table->string('no_wa');
            $table->string('status_pegawai');
            $table->string('ruangan');
            $table->string('tahun_pensiun');
            $table->string('pendidikan_terakhir');
            $table->string('tanggal_lulus');
            $table->string('no_ijazah');
            $table->string('jabatan');
            $table->integer('cuti_tahunan')->default(12);
            $table->integer('sisa_cuti_tahunan')->nullable();
            $table->string('masa_kerja')->nullable();
            $table->enum('status_tenaga', ['asn', 'non asn']);
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
