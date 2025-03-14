<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stats_events', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('type');
            $table->bigInteger('value');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('stats_events');
    }
}
