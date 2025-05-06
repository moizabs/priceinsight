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
        Schema::create('zip_code_exceptions', function (Blueprint $table) {
            $table->id();
            $table->string('route_type')->nullable();
            $table->string('operation_type')->nullable();
            $table->integer('origin_zipcode')->nullable();
            $table->integer('destination_zipcode')->nullable();            
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
        Schema::dropIfExists('zip_code_exceptions');
    }
};
