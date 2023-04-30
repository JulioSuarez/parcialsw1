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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
<<<<<<< Updated upstream
            $table->integer('cantidad');
            $table->integer('precio_unitario');
            $table->string('formato');

=======
>>>>>>> Stashed changes
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('ventas');
            $table->unsignedBigInteger('id_foto');
            $table->foreign('id_foto')->references('id')->on('fotos');
<<<<<<< Updated upstream
=======
            $table->integer('cantidad');
            $table->decimal('precio');
            $table->string('formato');
>>>>>>> Stashed changes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
