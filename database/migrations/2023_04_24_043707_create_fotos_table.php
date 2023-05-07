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
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();

            $table->string('foto_path');

            $table->unsignedBigInteger('id_fotoestudio');
            $table->foreign('id_fotoestudio')->references('id')->on('fotoestudios');

            $table->unsignedBigInteger('id_evento');
            $table->foreign('id_evento')->references('id')->on('eventos');

            $table->unsignedBigInteger('id_album_fotos')->nullable();
            $table->foreign('id_album_fotos')->references('id')->on('album_fotos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos');
    }
};
