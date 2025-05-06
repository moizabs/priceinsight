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
        Schema::create('pricing_options', function (Blueprint $table) {
            $table->id();
            $table->enum('disabled_vehicle', ['Yes', 'No'])->nullable();
            $table->float('in_operable')->nullable();
            $table->float('enclosed_transport')->nullable();
            $table->float('deposit_amount')->nullable();
            $table->enum('hide_deposit', ['Yes', 'No'])->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_options');
    }
};
