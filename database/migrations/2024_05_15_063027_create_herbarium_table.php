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
        Schema::create('herbarium', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('family_id')->index()->nullable();
            $table->foreignId('place_id')->index()->nullable();
            $table->foreignId('taluk_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('state_id')->nullable();
            $table->foreignId('genus_id')->index()->nullable();
            $table->foreignId('status_id')->index()->nullable();
            $table->foreignId('collector1_id')->index()->nullable();
            $table->foreignId('collector2_id')->index()->nullable();
            $table->foreignId('collector3_id')->nullable();
            $table->foreignId('specific_id')->nullable();

            $table->string('collection_number', length: 32)->index()->nullable();
            $table->string('herbarium_number', length: 32)->index()->nullable();
            $table->string('vernacular_name')->nullable();
            $table->integer('quantity_main')->nullable();
            $table->integer('quantity_duplicate')->nullable();
            $table->string('quantity_lent')->nullable();
            $table->text('notes')->nullable();
            $table->date('collected_on')->index()->nullable();
            $table->string('latitude', length: 32)->nullable();
            $table->string('longitude', length: 32)->nullable();
            $table->string('altitude', length: 32)->nullable();
            $table->string('habit', length: 32)->nullable();
            $table->text('description')->nullable();
            $table->text('association')->nullable();
            $table->string('frequency', length: 32)->nullable();
            $table->string('micro_habitat', length: 64)->nullable();
            $table->text('leaf')->nullable();
            $table->string('phenology', length: 64)->nullable();
            $table->text('flower')->nullable();
            $table->text('fruit')->nullable();
            $table->text('seeds')->nullable();
            $table->string('forest', length: 64)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herbarium');
    }
};
