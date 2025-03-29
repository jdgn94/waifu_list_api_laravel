<?php

use App\Enums\ChatType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('telegram_id')->unique();
            $table->enum('chat_type', array_column(ChatType::cases(), 'value'));
            $table->integer('limit_message', false, true)->default(100);
            $table->boolean('character_active')->default(false);
            $table->integer('limit_message_to_delete', false, true)->default(50);
            $table->integer('message_count', false, true)->default(0);
            $table->integer('message_to_delete_count', false, true)->default(0);
            $table->string('language', 4)->default('es');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
