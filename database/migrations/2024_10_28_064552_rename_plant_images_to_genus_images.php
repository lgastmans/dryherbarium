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
        Schema::rename('plant_images', 'genus_images');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('genus_images', 'plant_images');
    }
};
