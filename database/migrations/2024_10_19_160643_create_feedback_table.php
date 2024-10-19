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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['website', 'organization']);
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('reported_by_id')->nullable();
            $table->boolean('is_archived')->default(false);

            $table->foreign('reported_by_id')->on('users')->references('id')
                ->cascadeOnUpdate()->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
