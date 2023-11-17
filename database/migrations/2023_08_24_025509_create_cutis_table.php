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
            $table->foreignId('pegawai_id')->constrained('pegawais')->onUpdate('cascade')->onDelete('cascade');
            $table->string('jenis_cuti')->nullable();
            $table->string('alasan_cuti')->nullable();
            $table->string('mulai_cuti')->nullable();
            $table->string('selesai_cuti')->nullable();
            $table->integer('jumlah_hari')->nullable();
            $table->enum('status',['aktif', 'nonaktif','pending'])->nullable();
            $table->string('link_cuti')->nullable();    
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
