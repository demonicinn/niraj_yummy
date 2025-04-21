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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('capacity')->nullable();
            $table->string('latitue')->nullable();
            $table->string('longitude')->nullable();
            $table->string('booking_mode')->nullable();
            $table->string('last_updated')->nullable();
            $table->string('open_now')->nullable();
            $table->string('website_link')->nullable();
            $table->string('distance')->nullable();
            $table->string('rating')->nullable();
            $table->string('user_ratings_total')->nullable();
            $table->string('place_id')->nullable();
            $table->string('image_url')->nullable();
            $table->string('formatted_address')->nullable();
            $table->string('formatted_phone_number')->nullable();
            
            //...
            $table->longText('editorial_summary')->nullable();
            $table->longText('geometry')->nullable();
            $table->longText('opening_hours')->nullable();
            $table->longText('photos')->nullable();
            $table->longText('reviews')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};