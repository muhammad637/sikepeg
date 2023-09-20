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
        Schema::create('mutasis', function (Blueprint $table){

            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ruangan_awal')->nullable();
            $table->string('ruangan_tujuan')->nullable();
            $table->string('instansi_awal')->nullable();
            $table->string('instansi_tujuan')->nullable();
            $table->enum('jenis_mutasi', ['internal', 'eksternal']);
            $table->date('tanggal_berlaku')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->string('link_sk')->nullable();
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};