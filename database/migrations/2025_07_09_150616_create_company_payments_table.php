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
        Schema::create('company_payments', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->integer("company_id")->unsigned()->nullable();
            $table->integer("payment_item_id")->unsigned();
            $table->string("reference_number");
            $table->double("amount_paid", 12, 2);
            $table->double("fee_charged", 12, 2);
            $table->double("total", 12, 2);
            $table->enum("status", ["pending", "payment successful", "payment failed"])->default("pending");
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_payments');
    }
};
