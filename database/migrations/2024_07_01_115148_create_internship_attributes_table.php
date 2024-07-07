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
        Schema::create('internship_attributes', function (Blueprint $table) {
            $table->id();

            $table->string('key')->comment('The possible values are: year, language, track');
            $table->string('value');

            $table->unsignedBigInteger('company_id');

            $table->foreign('company_id')->references('id')->on('companies')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_attributes');
    }
};
