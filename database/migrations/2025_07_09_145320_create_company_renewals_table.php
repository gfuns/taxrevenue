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
        Schema::create('company_renewals', function (Blueprint $table) {
            $table->id();
            $table->integer("company_id")->unsigned();
            $table->string("reference_number");
            $table->string("company_name");
            $table->string("company_address");
            $table->string("expiry_date");
            $table->string("phone_number");
            $table->string("email");
            $table->integer("period");
            $table->string("bsppc_number");
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
        Schema::dropIfExists('company_renewals');
    }
};
