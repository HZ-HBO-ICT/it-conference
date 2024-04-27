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
        Schema::create('presentations', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description');
            $table->boolean('is_approved')->default(false);
            $table->unsignedInteger('max_participants')
                ->comment('The max number of participants that the presenter allows;
                If left empty it would be based on the room capacity')
                ->nullable();
            $table->string('type')
                ->comment('Can be only lecture or workshop');
            $table->string('file_path', 2048)->nullable()
                ->comment('Path to the uploaded presentation by the speaker');
            $table->string('file_original_name')->nullable();

            $table->unsignedBigInteger('timeslot_id')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('difficulty_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();

            $table->foreign('timeslot_id')->references('id')->on('timeslots')
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('room_id')->references('id')->on('rooms')
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('difficulty_id')->references('id')->on('difficulties')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('company_id')->references('id')->on('companies')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentations');
    }
};
