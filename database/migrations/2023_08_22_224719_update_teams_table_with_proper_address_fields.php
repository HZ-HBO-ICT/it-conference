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
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->string('postcode')->nullable(false);
            $table->string('house_number')->nullable(false);
            $table->string('street')->nullable(false);
            $table->string('city')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('address')->nullable(false);
            $table->dropColumn('postcode');
            $table->dropColumn('house_number');
            $table->dropColumn('street');
            $table->dropColumn('city');
        });
    }
};
