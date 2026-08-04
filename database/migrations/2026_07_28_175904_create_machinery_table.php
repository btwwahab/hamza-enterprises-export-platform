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
        Schema::create('machinery', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('maker');
            $table->string('model');
            $table->string('category');
            $table->unsignedSmallInteger('year');
            $table->unsignedInteger('price');
            $table->unsignedInteger('hours');
            $table->string('fuel');
            $table->string('capacity')->nullable();
            $table->string('location');
            $table->string('item_no')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('engine')->nullable();
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
        Schema::dropIfExists('machinery');
    }
};
