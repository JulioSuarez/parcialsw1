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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            //monto
            $table->decimal('monto');
            //fecha
            $table->date('fecha');
            //comprobante
            $table->string('comprobante');
            //id orden de pago
            $table->unsignedBigInteger('id_orden_pago');
            $table->foreign('id_orden_pago')->references('id')->on('orden_pagos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
