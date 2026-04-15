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
        Schema::table('destination_activities', function (Blueprint $table) {
            $table->double('activity_cost')->nullable()->change();
            $table->enum('reviews', ['1', '2', '3', '4', '5'])->nullable()->change();
            $table->json('best_months')->nullable()->change();
            $table->unsignedBigInteger('city_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destination_activities', function (Blueprint $table) {
            $table->double('activity_cost')->nullable(false)->change();
            $table->enum('reviews', ['1', '2', '3', '4', '5'])->nullable(false)->change();
            $table->json('best_months')->nullable(false)->change();
            $table->unsignedBigInteger('city_id')->nullable(false)->change();
        });
    }
};
