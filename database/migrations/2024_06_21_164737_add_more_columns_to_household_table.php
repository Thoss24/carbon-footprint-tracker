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
        Schema::table('household', function (Blueprint $table) {

            $table->enum('electricity metric', ['kWh'])->after('electricity');
            $table->enum('natural gas metric', ['kWh', 'therms', 'GBP'])->after('natural_gas');
            $table->enum('heating oil metric', ['kWh', 'litres', 'gallons'])->after('heating_oil');
            $table->enum('coal metric', ['kWh', 'kg'])->after('coal');
            $table->enum('lpg metric', ['litres', 'therms', 'gallons'])->after('lpg');
            $table->enum('propane metric', ['litres', 'gallons'])->after('propane');
            $table->enum('wood metric', ['kg'])->after('wood');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('household', function (Blueprint $table) {
            $table->dropColumn(['electricity metric', 'natural gas metric', 'heating oil metric', 'coal metric', 'lpg metric', 'propane', 'wood']);
        });
    }
};