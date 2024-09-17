<?php

use App\Models\Edition;
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
        Schema::create('editions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('state')->default(Edition::STATE_DESIGN);
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->integer('lecture_duration')->default(30);
            $table->integer('workshop_duration')->default(90);
            $table->string('keynote_name')->nullable();
            $table->text('keynote_description')->nullable();
            $table->string('keynote_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editions');
    }
};
