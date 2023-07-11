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
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('presentation_id');
            $table->boolean('is_main_speaker')
                ->comment('Since there can be multiple presenters for a single presentation');

            $table->boolean('is_approved')->default(false);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('presentation_id')->references('id')->on('presentations');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }
};
