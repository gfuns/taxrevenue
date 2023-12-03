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
        Schema::create('private_conversations', function (Blueprint $table) {
            $table->id();
            $table->integer('private_chat_id')->unsigned();
            $table->integer('sender_id')->unsigned();
            $table->string('message_type');
            $table->text('message');
            $table->text('file_name')->nullable();
            $table->text('file_size')->nullable();
            $table->integer('status')->default(0);
            $table->integer('sender_deleted')->default(0);
            $table->integer('recipient_deleted')->default(0);
            $table->timestamps();
            $table->foreign('private_chat_id')->references('id')->on('private_chats')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_conversations');
    }
};
