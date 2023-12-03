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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('business_id')->unsigned();
            $table->text('job_title');
            $table->text('tags');
            $table->string('skill_level');
            $table->longText('job_description');
            $table->longText('job_requirements');
            $table->integer('open_positions')->default(1);
            $table->string('duration');
            $table->enum('location_type', ['remote', 'on-site', 'hybrid']);
            $table->string('country');
            $table->string('country_iso');
            $table->string('state');
            $table->string('city');
            $table->string('street');
            $table->double('minimum_salary', 12, 2);
            $table->double('maximum_salary', 12, 2);
            $table->string('salary_rate');
            $table->string('currency');
            $table->date('application_commencement');
            $table->date('application_deadline');
            $table->text('languages')->default("English");
            $table->text('job_categories');
            $table->text('engagement_type');
            $table->enum('visibility', ["open", 'in-progress', 'completed', 'closed', 'draft'])->default("open");
            $table->enum('status', ["draft", 'published'])->default("draft");
            $table->string('author')->default("Business");
            $table->string('tracking_code');
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
