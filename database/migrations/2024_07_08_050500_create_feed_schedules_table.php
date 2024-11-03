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
        Schema::create('feed_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('hourOne');
            $table->integer('minuteOne');
            $table->integer('hourTwo');
            $table->integer('minuteTwo');
            $table->integer('hourThree');
            $table->integer('minuteThree');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feed_schedules');
    }
};
