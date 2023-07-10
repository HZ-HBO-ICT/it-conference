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
            $table->unsignedBigInteger('sponsor_tier_id')
                ->nullable();
            $table->boolean('is_sponsor_approved')
                ->nullable();

            $table->foreign('sponsor_tier_id')->references('id')->on('sponsor_tiers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('is_sponsor_approved');
            $table->dropColumn('sponsor_tier_id');
        });
    }
};
