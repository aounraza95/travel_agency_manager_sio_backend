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
        Schema::create('tourist_spots', function (Blueprint $table) {
            $table->id();
            $table->string('tourist_spot_name');
            $table->string('tourist_spot_address');
            $table->enum('reviews', ['1', '2', '3', '4', '5']);
            $table->double('tourist_spot_cost');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->unsignedBigInteger('tourist_spot_type_id');
            $table->foreign('tourist_spot_type_id')->references('id')->on('tourist_spot_types')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourist_spots');
    }
};
