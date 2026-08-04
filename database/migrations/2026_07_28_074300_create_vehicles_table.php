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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('maker');
            $table->string('model');
            $table->unsignedSmallInteger('year');
            $table->unsignedInteger('price');
            $table->unsignedInteger('mileage');
            $table->string('fuel');
            $table->string('transmission');
            $table->string('body');
            $table->string('location');
            $table->string('item_no')->nullable();
            $table->string('vin_no')->nullable();
            $table->string('engine')->nullable();
            $table->string('drive')->nullable();
            $table->string('seats')->nullable();
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->string('status')->default('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
