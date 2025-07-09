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
        Schema::create('companies', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->string("company_name");
            $table->string("company_address");
            $table->string("postal_code")->nullable();
            $table->string("business_category");
            $table->string("classification");
            $table->string("previously_registered");
            $table->string("prev_reg_classification");
            $table->string("prev_reg_category");
            $table->string("prev_reg_period");
            $table->string("prev_reg_number");
            $table->string("prev_reg_validity");
            $table->string("invalid_prev_reg_reason");
            $table->string("experience");
            $table->longText("experience_details");
            $table->double("capital", 12, 2);
            $table->string("reference_number");
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
