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
        Schema::create('planes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_plan');
<<<<<<< Updated upstream:database/migrations/2023_04_23_043545_create_planes_table.php
            $table->string('precio');
=======
            $table->decimal('precio');
>>>>>>> Stashed changes:database/migrations/2023_04_25_043545_create_planes_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes');
    }
};
