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
            $table->renameColumn('electricity metric', 'electricity_metric');
            $table->renameColumn('natural gas metric', 'natural_gas_metric');
            $table->renameColumn('heating oil metric', 'heating_oil_metric');
            $table->renameColumn('coal metric', 'coal_metric');
            $table->renameColumn('lpg metric', 'lpg_metric');
            $table->renameColumn('propane metric', 'propane_metric');
            $table->renameColumn('wood metric', 'wood_metric');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('household', function (Blueprint $table) {
            $table->renameColumn('electricity_metric', 'electricity metric');
            $table->renameColumn('natural_gas_metric', 'natural gas metric');
            $table->renameColumn('heating_oil_metric', 'heating oil metric');
            $table->renameColumn('coal_metric', 'coal metric');
            $table->renameColumn('lpg_metric', 'lpg metric');
            $table->renameColumn('propane_metric', 'propane metric');
            $table->renameColumn('wood_metric', 'wood metric');
        });
    }
};
