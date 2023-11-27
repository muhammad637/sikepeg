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
        Schema::create('kenaikan_pangkats', function (Blueprint $table){
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('pangkat_id')->constrained('pangkats')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('golongan_id')->constrained('golongans')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('pangkat_id')->nullable();
            $table->foreign('pangkat_id')->references('id')->on('pangkats');
            $table->string('pangkat_id_sebelumnya')->nullable();
            $table->string('golongan_id_sebelumnya')->nullable();
            $table->string('jabatan_sebelumnya')->nullable();
            $table->string('tmt_sebelumnya')->nullable();
            $table->string('jabatan')->nullable();
            $table->date('tmt_pangkat_dari')->nullable();
            $table->date('tmt_pangkat_sampai')->nullable();
            $table->string('no_sk')->nullable();
            $table->string('tanggal_sk')->nullable();
            $table->string('penerbit_sk')->nullable();
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
