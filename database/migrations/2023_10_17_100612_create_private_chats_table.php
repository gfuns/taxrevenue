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
        Schema::create('private_chats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id')->unsigned();
            $table->integer('recipient_id')->unsigned();
            $table->integer('sender_deleted')->default(0);
            $table->integer('recipient_deleted')->default(0);
            $table->timestamps();
            $table->foreign('sender_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_chats');
    }
};
