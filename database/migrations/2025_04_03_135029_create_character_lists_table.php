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
        Schema::create('character_lists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('character_image_id', false, true);
            $table->bigInteger('user_id', false, true);
            $table->integer('quantity', false, true);
            $table->integer('points', false, true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('character_image_id')->references('id')->on('character_images')->onDelete('cascade');
            $table->unique(['user_id', 'character_image_id'], 'user_character_image_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_lists');
    }
};
