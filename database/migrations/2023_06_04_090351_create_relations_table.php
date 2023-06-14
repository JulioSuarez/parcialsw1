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
        Schema::create('relations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('clase_origen')->nullable();
            $table->foreign('clase_origen')->references('id')->on('clases')->onDelete('cascade');

            $table->unsignedBigInteger('clase_destino')->nullable();
            $table->foreign('clase_destino')->references('id')->on('clases')->onDelete('cascade');

            $table->unsignedBigInteger('tipo_relacion')->nullable();
            $table->foreign('tipo_relacion')->references('id')->on('relation_tipos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relations');
    }
};
