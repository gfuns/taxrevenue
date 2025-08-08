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
        Schema::table('payment_histories', function (Blueprint $table) {
            $table->integer("tax_payer_id")->unsigned();
            $table->integer('period')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_histories', function (Blueprint $table) {
            $table->foreign('tax_payer_id')->references('id')->on('tax_payers')->onDelete('cascade');
            $table->dropColumn('period');
        });
    }
};
