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
        Schema::create('freight_listings', function (Blueprint $table) {
            $table->id();
            $table->string('origin_location', 255)->nullable();
            $table->string('destination_location', 255)->nullable();
            $table->string('trailer_type')->nullable();
            $table->string('load_type')->nullable();
            $table->double('freight_width')->nullable();
            $table->double('freight_length')->nullable();
            $table->double('posting_rate')->nullable();
            $table->double('carrier_offer')->nullable();
            $table->double('shipper_charge')->nullable();
            $table->double('acceptance_rate')->nullable();
            $table->double('total_average')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freight__listings');
    }
};
