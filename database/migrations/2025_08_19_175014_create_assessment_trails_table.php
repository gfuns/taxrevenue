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
        Schema::create('assessment_trails', function (Blueprint $table) {
            $table->id();
            $table->integer("assessment_id")->unsigned();
            $table->integer("user_id")->unsigned();
            $table->enum("role", ["assessing officer", "reviewing office", "approving officer"]);
            $table->double("amount_quoted", 20, 2);
            $table->timestamps();
            $table->foreign('assessment_id')->references('id')->on('assessments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_trails');
    }
};
