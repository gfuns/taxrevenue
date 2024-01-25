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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned();
            $table->integer('artisan_id')->unsigned();
            $table->integer('job_listing_id')->unsigned();
            $table->longText('cover_letter');
            $table->string('hiring_status')->default("Pending");
            $table->string('completion_status')->default("Pending");
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('artisan_id')->references('id')->on('artisans')->onDelete('cascade');
            $table->foreign('job_listing_id')->references('id')->on('job_listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
