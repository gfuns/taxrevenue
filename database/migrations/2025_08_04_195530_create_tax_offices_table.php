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
        Schema::create('tax_offices', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('lga_id')->unsigned();
            $table->text("tax_office");
            $table->text("address");
            $table->string("email")->nullable();
            $table->string("phone_number")->nullable();
            $table->enum("status", ["active", "deactivated"])->default("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_offices');
    }
};
