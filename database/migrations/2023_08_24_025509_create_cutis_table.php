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
        Schema::create('cutis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->constrained('pegawai_id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('jenis_cuti');
            $table->string('alasan_cuti');
            $table->string('mulai_cuti');
            $table->string('selesai_cuti');
            $table->integer('jumlah_hari');
            $table->string('status');
           
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
        Schema::dropIfExists('cutis');
    }
};
