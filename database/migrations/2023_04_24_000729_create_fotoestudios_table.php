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
        Schema::create('fotoestudios', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->string('nit')->nullable();
<<<<<<<< Updated upstream:database/migrations/2023_04_24_0001729_create_fotoestudios_table.php
            $table->integer('puntuacion')->nullable();
========
>>>>>>>> Stashed changes:database/migrations/2023_04_24_000729_create_fotoestudios_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotoestudios');
    }
};
