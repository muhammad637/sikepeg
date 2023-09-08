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
        Schema::create('asns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tmt_cpns');
            $table->string('tmt_pns');
            $table->string('tmt_pangkat_terakhir');
            $table->string('pangkat_golongan');
            $table->string('sekolah');
            $table->enum('jenis_tenaga', ['struktural', 'umum', 'nakes']);  # memunculkan piihan apakah itu nakes, umum, ataupun
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
        Schema::dropIfExists('asns');
    }
};
