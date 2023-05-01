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
        Schema::create('orden_pagos', function (Blueprint $table) {
            $table->id();
            //monto
            $table->decimal('monto');
            //fecha limite
            $table->string('fecha_limite');
            //descripcion
            $table->string('descripcion');
            //estado
            $table->string('estado');
            //metodo qr
            $table->string('metodo_qr');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_pagos');
    }
};
