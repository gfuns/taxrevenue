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
            $table->text('slug');
            $table->text('tags');
            $table->longText('company_description');
            $table->longText('job_description');
            $table->enum('location', ['remote', 'in-office', 'hybrid']);
            $table->string('country');
            $table->string('country_iso');
            $table->string('state');
            $table->string('city');
            $table->double('minimum_salary', 12, 2);
            $table->double('maximum_salary', 12, 2);
            $table->string('salary_rate');
            $table->string('currency');
            $table->text('job_categories');
            $table->text('engagement_type');
            $table->string('author')->default("Business");
            $table->longText('application_url');
            $table->enum('status', ["draft", 'published', 'archived'])->default("draft");

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
