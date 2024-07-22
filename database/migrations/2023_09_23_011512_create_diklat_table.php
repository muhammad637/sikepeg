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
        Schema::create('diklats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('ruangan_id')->constrained('ruangans')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_diklat')->nullable();
            $table->string('tanggal_mulai')->nullable();
            $table->string('tanggal_selesai')->nullable();
            $table->integer('jumlah_hari')->nullable();
            $table->integer('jumlah_jam')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->string('tempat')->nullable();
            $table->string('tahun')->nullable();
            $table->string('no_sertifikat')->nullable();
            $table->date('tanggal_sertifikat')->nullable();
            $table->string('link_sertifikat')->nullable();
            $table->enum(
                'status_diklat',
                ['diterima, ditolak', 'pending']
            )->default('pending');
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
        Schema::dropIfExists('diklat');
    }
};
