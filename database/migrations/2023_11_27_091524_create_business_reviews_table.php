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
        Schema::create('business_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('rating');
            $table->longText('review');
            $table->timestamps();
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_reviews');
    }
};
