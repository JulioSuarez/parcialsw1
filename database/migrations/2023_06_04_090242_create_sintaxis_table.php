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
        Schema::create('sintaxis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('atributos_id')->unsigned()->nullable();
            $table->foreign('atributos_id')->references('id')->on('atributos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sintaxis');
    }
};
