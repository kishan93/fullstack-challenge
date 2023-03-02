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
        Schema::create('location_grids', function (Blueprint $table) {
            $table->id();
            $table->integer('x');
            $table->integer('y');
            $table->string('wfo');
            $table->text('weather_data')->nullable();
            $table->timestamps();

            $table->index(['x','y']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_grids');
    }
};
