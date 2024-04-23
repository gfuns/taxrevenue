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
        Schema::create('forum_images', function (Blueprint $table) {
            $table->id();
            $table->integer("forum_post_id")->unsigned();
            $table->text("image");
            $table->timestamps();
            $table->foreign('forum_post_id')->references('id')->on('forum_posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_images');
    }
};
