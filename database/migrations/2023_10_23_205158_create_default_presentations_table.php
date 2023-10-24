<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('default_presentations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('description')->nullable(false);

            $table->string('type')->comment('What part of the conference is the presentation')
                ->nullable(false);

            $table->unsignedBigInteger('timeslot_id');
            $table->unsignedBigInteger('room_id');
            $table->foreign('timeslot_id')->references('id')->on('timeslots');
            $table->foreign('room_id')->references('id')->on('rooms');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_presentations');
    }
};
