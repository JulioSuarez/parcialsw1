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
            $table->bigInteger('clase_a')->unsigned();
            $table->foreign('clase_a')->references('id')->on('clases');
            $table->bigInteger('clase_b')->unsigned();
            $table->foreign('clase_b')->references('id')->on('clases');
            $table->bigInteger('tipo_relacion')->unsigned();
            $table->foreign('tipo_relacion')->references('id')->on('relation_tipos');
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
