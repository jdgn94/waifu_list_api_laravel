<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('special_image_franchises', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('special_image_id', false, true);
            $table->bigInteger('franchise_id', false, true);
            $table->bigInteger('user_id', false, true)->nullable();
            $table->timestamps();

            $table->foreign('special_image_id')->references('id')->on('special_images')->onDelete('cascade');
            $table->foreign('franchise_id')->references('id')->on('franchises')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_image_franchises');
    }
};
