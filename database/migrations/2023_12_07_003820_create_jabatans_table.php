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
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais');
            $table->string('jabatan_sebelumnya')->nullable() ;
            $table->string('jabatan_selanjutnya')->nullable();
            $table->string('tanggal_berlaku')->nullable();
            $table->string('no_sk')->nullable();
            $table->string('tanggal_sk')->nullable();
            $table->string('link_sk')->nullable();
            $table->enum('type', ['demosi', 'promosi']);
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
        Schema::dropIfExists('jabatans');
    }
};
