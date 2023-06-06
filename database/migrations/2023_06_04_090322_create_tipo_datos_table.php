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
            $table->string('llave_primaria')->nullable();
            $table->string('llave_foranea')->nullable();
            $table->bigInteger('sintaxis_id')->unsigned();
            $table->foreign('sintaxis_id')->references('id')->on('sintaxis');
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
