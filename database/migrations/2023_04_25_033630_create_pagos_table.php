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
<<<<<<< Updated upstream:database/migrations/2023_04_25_043630_create_pagos_table.php
            //monto
            $table->string('monto');
=======
            $table->decimal('monto');
>>>>>>> Stashed changes:database/migrations/2023_04_25_033630_create_pagos_table.php
            //fecha
            $table->date('fecha');
            //comprobante
            $table->string('comprobante');
<<<<<<< Updated upstream:database/migrations/2023_04_25_043630_create_pagos_table.php
            //id orden de pago
            $table->unsignedBigInteger('id_orden_pago');
            $table->foreign('id_orden_pago')->references('id')->on('orden_pagos');
            
=======
            //orden de pago
            $table->unsignedBigInteger('id_orden_pago');
            $table->foreign('id_orden_pago')->references('id')->on('orden_pagos');
>>>>>>> Stashed changes:database/migrations/2023_04_25_033630_create_pagos_table.php
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
