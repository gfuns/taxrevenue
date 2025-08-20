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
        Schema::create('assessments', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->integer("tax_payer_id")->unsigned();
            $table->integer("returns_id")->unsigned();
            $table->double("computed_tax", 20, 2)->nullable();
            $table->integer("assessing_officer")->unsigned()->nullable();
            $table->timestamp("assessment_date")->nullable();
            $table->integer("reviewing_officer")->unsigned()->nullable();
            $table->timestamp("date_reviewed")->nullable();
            $table->integer("approving_officer")->unsigned()->nullable();
            $table->timestamp("date_approved")->nullable();
            $table->enum("status", ["awaiting assessment", "assessed", "objected", "accepted", "paid"])->default("awaiting assessment");
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tax_payer_id')->references('id')->on('tax_payers')->onDelete('cascade');
            $table->foreign('returns_id')->references('id')->on('returns')->onDelete('cascade');
            $table->foreign('assessing_officer')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reviewing_officer')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approving_officer')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
