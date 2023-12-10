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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->text('post_title');
            $table->text('tags');
            $table->text('slug');
            $table->text('cover_photo');
            $table->longText('blog_post');
            $table->enum('status', ['draft', 'published', 'unpublished']);
            $table->enum('visibility', ['public', 'private']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
