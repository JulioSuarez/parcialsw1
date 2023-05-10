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
            $table->string('estado')->default('0')->nullable();

            $table->unsignedBigInteger('id_fotoestudio');
            $table->foreign('id_fotoestudio')->references('id')->on('users');

            $table->unsignedBigInteger('id_evento');
            $table->foreign('id_evento')->references('id')->on('eventos');

            $table->unsignedBigInteger('id_album_evento')->nullable();
            $table->foreign('id_album_evento')->references('id')->on('album_eventos');

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
