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
        Schema::create('solutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('goal_id');
            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->integer('impact_score')->nullable(); // Optional score
            $table->timestamps();
            $table->foreign('goal_id')->references('id')->on('goals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solutions');
    }
};
