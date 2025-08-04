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
        Schema::create('collection_agents', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('terminal_id')->unsigned()->nullable();
            $table->string("surname");
            $table->string("first_name");
            $table->string("other_names")->nullable();
            $table->string("email")->unique();
            $table->string("phone_number")->unique();
            $table->enum("gender", ["male", "female"]);
            $table->string("photo")->nullable();
            $table->enum('status', ["active", "suspended", "banned"])->default("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_agents');
    }
};
