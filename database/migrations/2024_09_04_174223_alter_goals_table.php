<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('goals', function (Blueprint $table) {
            DB::statement("ALTER TABLE goals MODIFY COLUMN type ENUM('household', 'secondary', 'car', 'flights', 'bus & rail')");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('goals', function (Blueprint $table) {
            DB::statement("ALTER TABLE goals MODIFY type ENUM('household', 'secondary', 'car', 'flights', 'bus & rail')");
        });
    }
};
