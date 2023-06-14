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
        Schema::create('tipo_datos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('size')->nullable();
            $table->unsignedBigInteger('id_formato')->nullable();
            $table->foreign('id_formato')->references('id')->on('formatos');
            $table->unsignedBigInteger('id_atributo')->nullable();
            $table->foreign('id_atributo')->references('id')->on('atributos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_datos');
    }
};
