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
        Schema::create('pos_terminals', function (Blueprint $table) {
            $table->increments("id");
            $table->string("model");
            $table->string("terminal_id");
            $table->string("serial_number");
            $table->string("sim")->nullable();
            $table->boolean("assigned")->default(0);
            $table->text("agent")->nullable();
            $table->integer("agent_id")->unsigned()->nullable();
            $table->text("assigned_location")->nullable();
            $table->string("longitude")->nullable();
            $table->string("latitude")->nullable();
            $table->string("ip_address")->nullable();
            $table->string("port")->nullable();
            $table->string("notification_ip")->nullable();
            $table->enum("status", ["active", "inactive", "deactivated"])->default("inactive");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_terminals');
    }
};
