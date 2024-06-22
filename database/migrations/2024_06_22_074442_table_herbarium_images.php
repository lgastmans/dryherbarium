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
        Schema::create('herbarium_images', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('herbarium_id')->required()->index();

            $table->string('filename', length: 32)->required()->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herbarium_images');
    }
};
