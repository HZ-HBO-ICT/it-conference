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
        Schema::create('presentation_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('colour');
            $table->integer('duration');

            $table->unsignedBigInteger('edition_id');
            $table->foreign('edition_id')->references('id')->on('editions')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentation_types');
    }
};
