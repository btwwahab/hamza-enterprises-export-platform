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
            $table->string('social_facebook')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('social_whatsapp')->nullable();
            $table->string('social_youtube')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['social_facebook', 'social_linkedin', 'social_whatsapp', 'social_youtube']);
        });
    }
};
