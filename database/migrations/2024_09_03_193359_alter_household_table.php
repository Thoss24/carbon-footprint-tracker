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
            $table->renameColumn('total_household_co2e', 'total_co2e');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('your_table_name', function (Blueprint $table) {
            $table->renameColumn('total_household_co2e', 'total_co2e');
        });
    }
};
