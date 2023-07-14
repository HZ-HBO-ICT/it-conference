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
        Schema::table('presentations', function (Blueprint $table) {
            $table->unsignedBigInteger('timeslot_id')->nullable()->change();
            $table->unsignedBigInteger('room_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presentations', function (Blueprint $table) {
            $table->unsignedBigInteger('timeslot_id')->nullable(false)->change();
            $table->unsignedBigInteger('room_id')->nullable(false)->change();
        });
    }
};
