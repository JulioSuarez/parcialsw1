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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
<<<<<<< Updated upstream
            $table->string('foto_perfil')->nullable();
            $table->string('foto_portada')->nullable();
            $table->string('telefono')->nullable();

            $table->unsignedBigInteger('id_plan');
            $table->foreign('id_plan')->references('id')->on('planes');

            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');

=======
            $table->string('prerfil_foto_path', 2048)->nullable();
            $table->string('portada_foto_path', 2048)->nullable();
            $table->string('telefono')->nullable();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')->references('id')->on('users');
>>>>>>> Stashed changes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
