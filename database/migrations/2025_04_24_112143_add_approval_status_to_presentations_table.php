<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ApprovalStatus;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('presentations', function (Blueprint $table) {
            $table->string('approval_status')->default(ApprovalStatus::APPROVED->value);
        });

        // Set all existing presentations to approved
        DB::table('presentations')->update(['approval_status' => ApprovalStatus::APPROVED->value]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presentations', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });
    }
};
