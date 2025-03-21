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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('website');
            $table->text('description');
            $table->text('motivation')->nullable(true);
            $table->string('phone_number')->nullable();
            $table->string('approval_status');
            $table->unsignedBigInteger('sponsorship_id')->nullable();
            $table->string('sponsorship_approval_status')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('dark_logo_path')->nullable();
            $table->string('postcode');
            $table->string('street');
            $table->string('house_number');
            $table->string('city');

            $table->foreign('sponsorship_id')->on('sponsorships')->references('id')
                ->cascadeOnUpdate()->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
