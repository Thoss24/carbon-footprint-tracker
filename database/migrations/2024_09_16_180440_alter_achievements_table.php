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
        Schema::table('achievements', function (Blueprint $table) {
            DB::statement("ALTER TABLE achievements MODIFY COLUMN carbon_footprint_type ENUM('transport', 'car', 'bus&rail', 'flights', 'secondary', 'household')");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            DB::statement("ALTER TABLE achievements MODIFY COLUMN carbon_footprint_type ENUM('transport', 'car', 'bus&rail', 'flights', 'secondary', 'household')");
        });
    }
};
