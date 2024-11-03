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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('information');
            $table->time('time');
            $table->date('date');
            $table->float('lastValueTemp')->nullable(); // Mengatur kolom sebagai nullable
            $table->float('lastValueFeed')->nullable(); // Mengatur kolom sebagai nullable
            $table->float('lastValuePh')->nullable(); // Mengatur kolom sebagai nullable
            $table->timestamp('lastNotified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
