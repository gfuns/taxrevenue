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
        Schema::create('individual_taxpayers', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->integer("tax_payer_id")->unsigned();
            $table->integer("tax_office_id")->unsigned();
            $table->string('last_name');
            $table->string('other_names');
            $table->enum("gender", ["male", "female"]);
            $table->date("dob");
            $table->string("nationality");
            $table->string("marital_status");
            $table->text("occupation");
            $table->double("annual_income");
            $table->string("state_origin")->nullable();
            $table->string("lga_origin")->nullable();
            $table->string("state_residence");
            $table->string("lga_residence");
            $table->string("city_residence");
            $table->string("house_number");
            $table->string("street_name");
            $table->text("business_type")->nullable();
            $table->string("tin")->nullable();
            $table->enum("public_servant", ["yes", "no"]);
            $table->enum("identification_type", ["nin", "bvn"]);
            $table->string("identification_number");
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tax_payer_id')->references('id')->on('tax_payers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('individual_taxpayers');
    }
};
