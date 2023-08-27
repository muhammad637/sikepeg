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
            $table->string('tmt_cpns');
            $table->string('tmt_pns');
            $table->string('tmt_pangkat_terakhir');
            $table->string('pangkat_golongan');
            $table->string('sekolah');
            $table->string('jenis_tenaga_struktural');
            $table->string('jabatan_struktural');
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
