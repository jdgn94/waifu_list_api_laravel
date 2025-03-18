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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('franchise_id', false, true);
            $table->bigInteger('type_id', false, true);
            $table->bigInteger('user_id', false, true)->nullable();
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->integer('age', false, true)->nullable();
            $table->timestamps();

            $table->foreign('franchise_id')->references('id')->on('franchises')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('character_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
