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
        Schema::create('household', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->integer('electricity');
            $table->enum('electricity_metric', ['kWh']);
            $table->integer('natural_gas');
            $table->enum('natural_gas_metric', ['kWh', 'therms', 'GBP']);
            $table->integer('heating_oil');
            $table->enum('heating_oil_metric', ['kWh', 'litres', 'gallons']);
            $table->integer('coal');
            $table->enum('coal_metric', ['kWh', 'kg']);
            $table->integer('lpg');
            $table->enum('lpg_metric', ['litres', 'therms', 'gallons']);
            $table->integer('propane');
            $table->enum('propane_metric', ['litres', 'gallons']);
            $table->integer('wood');
            $table->enum('wood_metric', ['kg']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('household');
    }
};
