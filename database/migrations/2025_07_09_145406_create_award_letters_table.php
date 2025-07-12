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
        Schema::create('award_letters', function (Blueprint $table) {
            $table->id();
            $table->integer("company_id")->unsigned();
            $table->string("reference_number");
            $table->text("company_name");
            $table->text("contract_name");
            $table->double("contract_amount", 12, 2);
            $table->date("award_date");
            $table->string("contract_duration");
            $table->text("mda");
            $table->text("tcc_cert");
            $table->text("cac_cert");
            $table->text("bsppc_cert");
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
        Schema::dropIfExists('award_letters');
    }
};
