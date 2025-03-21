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
        Schema::create('booths', function (Blueprint $table) {
            $table->id();

            $table->decimal('width');
            $table->decimal('length');
            $table->unsignedBigInteger('company_id')->unique();
            $table->text('additional_information')->nullable(true);
            $table->string('approval_status')->default('awaiting_approval');

            $table->foreign('company_id')->on('companies')->references('id')
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
        Schema::dropIfExists('booths');
    }
};
