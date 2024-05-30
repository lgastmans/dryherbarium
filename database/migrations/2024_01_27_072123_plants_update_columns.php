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
        Schema::table('plants', function (Blueprint $table) {
            $table->dropColumn('plant_species');
            $table->dropColumn('plant_genus');
            $table->string('plant_name')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->string('plant_species')->after('id');
            $table->string('plant_genus')->after('id');
            $table->dropColumn('plant_name');
        });
    }
};
