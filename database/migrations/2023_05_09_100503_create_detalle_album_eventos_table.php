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
        Schema::create('detalle_album_eventos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_foto');
            $table->foreign('id_foto')->references('id')->on('fotos');

            $table->unsignedBigInteger('id_album_evento');
            $table->foreign('id_album_evento')->references('id')->on('album_eventos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_album_eventos');
    }
};
