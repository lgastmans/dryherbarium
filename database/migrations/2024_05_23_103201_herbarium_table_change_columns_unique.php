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
        Schema::table('herbarium', function (Blueprint $table) {
            $table->foreignId('family_id')->required()->change();
            $table->foreignId('genus_id')->required()->change();
            $table->string('collection_number', length: 32)->required()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('herbarium', function (Blueprint $table) {
            $table->dropColumn('family_id');
            $table->dropColumn('genus_id');
            $table->dropColumn('collection_number', length: 32);
        });
    }
};
