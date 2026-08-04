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
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('maker');
            $table->string('model')->nullable();
            $table->string('category');
            $table->unsignedSmallInteger('year')->nullable();
            $table->unsignedInteger('price');
            $table->string('condition');
            $table->string('location')->nullable();
            $table->string('part_no')->nullable();
            $table->string('oem_no')->nullable();
            $table->string('engine_type')->nullable();
            $table->string('weight')->nullable();
            $table->string('fits_models')->nullable();
            $table->string('hp')->nullable();
            $table->unsignedInteger('stock')->nullable();
            $table->string('status')->default('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
