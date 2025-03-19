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
        Schema::create('special_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('image_type_id', false, true);
            $table->bigInteger('user_id', false, true)->nullable();
            $table->string('public_id');
            $table->string('public_url');
            $table->timestamps();

            $table->foreign('image_type_id')->references('id')->on('image_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_images');
    }
};
