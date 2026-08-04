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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_badge');
            $table->string('hero_headline');
            $table->text('hero_subheadline');
            $table->unsignedInteger('stat_vehicles')->default(0);
            $table->unsignedInteger('stat_dealers')->default(0);
            $table->unsignedInteger('stat_countries')->default(0);
            $table->string('company_name');
            $table->string('email')->nullable();
            $table->string('address_korea');
            $table->string('hamza_phone');
            $table->string('fatima_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
