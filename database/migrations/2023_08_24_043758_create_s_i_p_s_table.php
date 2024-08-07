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
        Schema::create('s_i_p_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_str')->nullable();
            $table->string('no_sip');
            $table->string('no_rekomendasi')->nullable();
            $table->string('penerbit_sip')->nullable();
            $table->string('tanggal_terbit_sip');
            $table->string('masa_berakhir_sip');
            $table->string('tempat_praktik')->nullable();
            $table->string('link_sip');
            $table->text('alamat_sip')->nullable();
            $table->enum('status', ['tolak', 'terima'])->default('terima');
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
        Schema::dropIfExists('s_i_p_s');
    }
};
