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
            $table->foreignId('pangkat_golongan_id')->constrained('pangkat_golongans')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('pangkat_golongan_sebelumnya_id')->constrained('pangkat_golongans')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('ruangan_id')->constrained('ruangans')->onUpdate('cascade');
           
            $table->string('tmt_sebelumnya')->nullable();
            $table->date('tmt_pangkat_dari')->nullable();
            $table->date('tmt_pangkat_sampai')->nullable();
            $table->string('no_sk')->nullable();
            $table->string('tanggal_sk')->nullable();   
            $table->string('penerbit_sk')->nullable();
            $table->text('link_sk')->nullable();
            $table->string('status_tipe')->nullable();
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
