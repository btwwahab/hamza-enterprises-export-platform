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
            foreach ([1, 2] as $i) {
                $table->string("showroom{$i}_tag")->nullable();
                $table->string("showroom{$i}_name")->nullable();
                $table->string("showroom{$i}_address")->nullable();
                $table->string("showroom{$i}_phone")->nullable();
                $table->string("showroom{$i}_whatsapp")->nullable();
                $table->string("showroom{$i}_maps_url")->nullable();

                $table->string("leader{$i}_tag")->nullable();
                $table->string("leader{$i}_name")->nullable();
                $table->string("leader{$i}_role")->nullable();
                $table->string("leader{$i}_phone")->nullable();
                $table->string("leader{$i}_whatsapp")->nullable();

                $table->string("bank{$i}_tag")->nullable();
                $table->string("bank{$i}_name")->nullable();
                foreach ([1, 2, 3, 4] as $r) {
                    $table->string("bank{$i}_row{$r}_label")->nullable();
                    $table->string("bank{$i}_row{$r}_value")->nullable();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $columns = [];
            foreach ([1, 2] as $i) {
                $columns = array_merge($columns, [
                    "showroom{$i}_tag", "showroom{$i}_name", "showroom{$i}_address", "showroom{$i}_phone", "showroom{$i}_whatsapp", "showroom{$i}_maps_url",
                    "leader{$i}_tag", "leader{$i}_name", "leader{$i}_role", "leader{$i}_phone", "leader{$i}_whatsapp",
                    "bank{$i}_tag", "bank{$i}_name",
                ]);
                foreach ([1, 2, 3, 4] as $r) {
                    $columns[] = "bank{$i}_row{$r}_label";
                    $columns[] = "bank{$i}_row{$r}_value";
                }
            }
            $table->dropColumn($columns);
        });
    }
};
