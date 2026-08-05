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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('office_hours_weekday')->nullable();
            $table->string('office_hours_saturday')->nullable();
            $table->string('office_hours_sunday')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['office_hours_weekday', 'office_hours_saturday', 'office_hours_sunday']);
        });
    }
};
