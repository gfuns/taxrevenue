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
            $table->enum("application_type", ["registration", "revalidation"]);
            $table->string("bsppc_number")->nullable();
            $table->string("cac_number")->nullable();
            $table->string("company_name");
            $table->string("company_address");
            $table->string("business_category");
            $table->string("classification");
            $table->enum("prev_reg", ["yes", "no"]);
            $table->string("prev_reg_class")->nullable();
            $table->string("prev_reg_where")->nullable();
            $table->string("prev_reg_works")->nullable();
            $table->string("prev_reg_when")->nullable();
            $table->string("prev_reg_no")->nullable();
            $table->enum("prev_reg_valid", ["yes", "no"])->nullable();
            $table->string("prev_reg_invalid_reason")->nullable();
            $table->enum("business_experience", ["yes", "no"]);
            $table->longText("experience_details")->nullable();
            $table->double("business_capital", 12, 2);
            $table->enum("operate_bank", ["yes", "no"]);
            $table->string("bank_name")->nullable();
            $table->string("bank_branch")->nullable();
            $table->string("account_number")->nullable();
            $table->string("bank_postal_address")->nullable();
            $table->enum("upgrade_application", ["yes", "no"]);
            $table->string("form_reference_number")->nullable();
            $table->string("reg_reference_number")->nullable();
            $table->enum("status", ["in progress", "pending", "approved", "rejected"])->default("in progress");
            $table->longText("rejection_reason")->nullable();
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
