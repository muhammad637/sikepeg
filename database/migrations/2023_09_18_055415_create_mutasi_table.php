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
            $table->string('jenis_pegawai');
            $table->string('ruangan_awal');
            $table->string('ruangan_tujuan');
            $table->enum('jenis_mutasi', ['internal', 'eksternal']);
            $table->date('tanggal');
            $table->string('no_sk');
            $table->date('tanggal_sk');
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
