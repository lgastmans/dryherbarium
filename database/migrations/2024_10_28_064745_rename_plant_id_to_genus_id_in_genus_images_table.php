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
        Schema::table('genus_images', function (Blueprint $table) {
            $table->renameColumn('plant_id', 'genus_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('genus_images', function (Blueprint $table) {
            $table->renameColumn('genus_id', 'plant_id');
        });
    }
};
