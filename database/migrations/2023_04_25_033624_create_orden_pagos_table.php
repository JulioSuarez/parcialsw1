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
<<<<<<< Updated upstream:database/migrations/2023_04_25_043624_create_orden_pagos_table.php
            $table->string('monto');
            //fecha limite
            $table->string('fecha_limite');
            //descripcion
            $table->string('descripcion');
            //estado
            $table->string('estado');
            //metodo qr
            $table->string('metodo_qr');
            
=======
            $table->decimal('monto');
            //descripcion
            $table->string('descripcion');
            //estado
            $table->boolean('estado');
            //fecha limite
            $table->date('fecha_limite');
            //forma de pago
            $table->string('metodo_qr');
>>>>>>> Stashed changes:database/migrations/2023_04_25_033624_create_orden_pagos_table.php
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
