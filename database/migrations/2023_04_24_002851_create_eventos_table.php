<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            //evento_name
            $table->string('evento_name');
            //descripcion
            $table->string('descripcion');
            //fecha
            $table->date('fecha');
            //hora
            $table->time('hora');
            //hora
            $table->time('horafin');
            //lugar
            $table->string('lugar');
            //foto
            $table->string('foto')->nullable();
            //estado
            $table->char('estado',1)->default('0')->nullable();
            //id_organizador
            $table->unsignedBigInteger('id_organizador')->nullable();
            $table->foreign('id_organizador')->references('id')->on('users');
            //id_fotoestudio
            $table->unsignedBigInteger('id_fotoestudio')->nullable();
            $table->foreign('id_fotoestudio')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
