<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->float('avgTemp', 8,1);
            $table->float('avgPh', 8,2);
            $table->float('avgFeed', 8,0);
            $table->string('status');
            $table->datetime('date');
            $table->string('reportInformation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
