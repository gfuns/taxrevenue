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
        Schema::create('power_of_attorneys', function (Blueprint $table) {
            $table->id();
            $table->integer("company_id")->unsigned();
            $table->string("reference_number");
            $table->text("donor_company");
            $table->text("donee_company");
            $table->text("donee_company_address");
            $table->text("donee_company_email");
            $table->text("donee_company_phone");
            $table->text("contract_name");
            $table->double("contract_amount", 12, 2);
            $table->string("contract_duration");
            $table->text("mda");
            $table->text("contract_agreement");
            $table->text("poa_document");
            $table->text("award_notification");
            $table->text("acceptance_letter");
            $table->text("boq_beme");
            $table->text("donee_company_profile");
            $table->double("amount_paid", 12, 2);
            $table->enum("status", ["pending", "awaiting approval", "approved", "rejected", "payment failed"])->default("pending");
            $table->longText("rejection_reason")->nullable();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('power_of_attorneys');
    }
};
