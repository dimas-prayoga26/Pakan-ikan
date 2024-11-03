<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('setting_datas', function (Blueprint $table) {
            $table->id();
            $table->decimal('tempMin', 8,0);
            $table->decimal('tempMax', 8,0);
            $table->decimal('phMin', 8,1);
            $table->decimal('phMax', 8,1);
            $table->integer('feedMax');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('setting_datas');
    }
};
