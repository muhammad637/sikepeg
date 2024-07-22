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
        Schema::create('s_t_r_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_sip')->nullable();
            $table->string('no_str');
            $table->string('kompetensi')->nullable();
            $table->string('no_sertikom')->nullable();
            $table->string('penerbit_str')->nullable();
            $table->string('tanggal_terbit_str');
            $table->string('masa_berakhir_str');
            $table->string('link_str');
            $table->enum('status_str',
            ['diterima, ditolak', 'pending'])->default('pending');
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
        Schema::dropIfExists('s_t_r_s');
    }
};
