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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
<<<<<<< Updated upstream
            $table->integer('precio_total');

            //id_cliente
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            //id_fotoestudio
            $table->unsignedBigInteger('id_fotoestudio');
            $table->foreign('id_fotoestudio')->references('id')->on('fotoestudios');

=======
            $table->decimal('precio_total');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->unsignedBigInteger('id_fotoestudio');
            $table->foreign('id_fotoestudio')->references('id')->on('fotoestudios');
>>>>>>> Stashed changes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
