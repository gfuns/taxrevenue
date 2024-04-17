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
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("customer_id")->unsigned();
            $table->integer("forum_category_id")->unsigned();
            $table->integer("forum_topic_id")->unsigned();
            $table->text("post_title");
            $table->text("post_body");
            $table->integer("likes");
            $table->integer("views");
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('forum_category_id')->references('id')->on('forum_categories')->onDelete('cascade');
            $table->foreign('forum_topic_id')->references('id')->on('forum_topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_posts');
    }
};
