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
        Schema::create('job_milestones', function (Blueprint $table) {
            $table->id();
            $table->integer('job_listing_id')->unsigned();
            $table->string('milestone');
            $table->longText('milestone_description');
            $table->string('currency');
            $table->double('milestone_fee', 12, 2);
            $table->string('status')->default('Pending');
            $table->date('deadline');
            $table->string('payment_status')->nullable();
            $table->timestamps();
            $table->foreign('job_listing_id')->references('id')->on('job_listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_milestones');
    }
};
