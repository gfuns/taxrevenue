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
        Schema::create('utility_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned();
            $table->string('transaction_id');
            $table->string('reference');
            $table->string('trx_type');
            $table->string('biller');
            $table->string('service_id')->nullable();
            $table->string('variation_code')->nullable();
            $table->string('plan_details')->nullable();
            $table->string('recipient');
            $table->string('recipient_name')->nullable();
            $table->string('recipient_address')->nullable();
            $table->double('amount', 12, 2);
            $table->double('fee', 12, 2);
            $table->double('total_amount', 12, 2);
            $table->string('payment_method')->default("Card Payment");
            $table->string('token')->nullable();
            $table->string('units')->nullable();
            $table->string('status')->default("Initiated");
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utility_transactions');
    }
};
