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
        Schema::create('state_exceptions', function (Blueprint $table) {
            $table->id();
            $table->string('origin_state')->nullable();
            $table->string('destination_state')->nullable();
            $table->string('route_type')->nullable();
            $table->string('operation_type')->nullable();
            $table->float('value')->nullable();
            $table->float('value_percentage')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_exceptions');
    }
};
