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
        Schema::create('job_assets', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code');
            $table->integer('job_listing_id')->unsigned()->nullable();
            $table->string('asset_type');
            $table->string('asset_name');
            $table->text('asset_url');
            $table->string('file_size');
            $table->string('file_type');
            $table->timestamps();
            $table->foreign('job_listing_id')->references('id')->on('job_listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_assets');
    }
};
