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
        Schema::create('suscripcions', function (Blueprint $table) {
            $table->id();
<<<<<<< Updated upstream
            $table->string('fecha_inicio');
            $table->string('fecha_fin');
            $table->string('estado');

            $table->unsignedBigInteger('id_plan');
            $table->foreign('id_plan')->references('id')->on('planes');

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');

            $table->unsignedBigInteger('id_orden_pago');
            $table->foreign('id_orden_pago')->references('id')->on('orden_pagos');

=======
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->boolean('estado');

            $table->unsignedBigInteger('id_orden_pago');
            $table->foreign('id_orden_pago')->references('id')->on('orden_pagos');
            $table->unsignedBigInteger('id_plan');
            $table->foreign('id_plan')->references('id')->on('planes');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');
>>>>>>> Stashed changes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suscripcions');
    }
};
