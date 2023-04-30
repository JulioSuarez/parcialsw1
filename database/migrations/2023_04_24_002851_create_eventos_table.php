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
<<<<<<< Updated upstream
            //evento_name
            $table->string('evento_name');
            //descripcion
            $table->string('descripcion');
            //fecha
            $table->date('fecha');
            //hora
            $table->time('hora');
            //lugar
            $table->string('lugar');
            //foto
            $table->string('foto')->nullable();
            //id_organizador
            $table->unsignedBigInteger('id_organizador');
            $table->foreign('id_organizador')->references('id')->on('organizadors');
            //id_fotoestudio
            $table->unsignedBigInteger('id_fotoestudio');
            $table->foreign('id_fotoestudio')->references('id')->on('fotoestudios');

=======
            $table->string('evento_name');
            $table->string('descripcion')->nullable();
            $table->date('fecha');
            $table->time('hora');
            $table->string('ubicacion');
            $table->unsignedBigInteger('id_organizacion');
            $table->foreign('id_organizacion')->references('id')->on('organizadors');
            $table->unsignedBigInteger('id_fotoestudio');
            $table->foreign('id_fotoestudio')->references('id')->on('fotoestudios');
>>>>>>> Stashed changes
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
