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
        Schema::create('residence_locations', function (Blueprint $table) {
            $table->id();
            $table->string('location_name');
            $table->string('location_address');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('location_type_id');
            $table->foreign('location_type_id')->references('id')->on('residence_types')->onDelete('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residence_locations');
    }
};
