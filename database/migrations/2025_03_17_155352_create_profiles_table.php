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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id', false, true)->unique();
            $table->bigInteger('role_id', false, true)->default(3);
            $table->bigInteger('telegram_id')->unique();
            $table->integer('level', false, true)->default(1);
            $table->integer('exp', false, true)->default(0);
            $table->integer('limit_exp', false, true)->default(100);
            $table->bigInteger('coins', false, true)->default(0);
            $table->bigInteger('diamonds', false, true)->default(0);
            $table->bigInteger('ticket', false, true)->default(100);
            $table->integer('favorite_pages', false, true)->default(1);
            $table->integer('favorite_pages_purchased', false, true)->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('info_id', false, true)->unique()->after('id');

            $table->foreign('info_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['info_id']);
            $table->dropColumn('info_id');
        });

        Schema::dropIfExists('profiles');
    }
};
