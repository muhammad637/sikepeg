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
        Schema::create('umum_strukturals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asn_id')->constrained('asns')->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_karpeg');
            $table->string('no_taspen');
            $table->string('no_npwp');
            $table->string('no_hp');
            $table->string('email');
            $table->string('pelatihan');
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
        Schema::dropIfExists('umum_strukturals');
    }
};