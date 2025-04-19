<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('frequent_questions', function (Blueprint $table) {
            $table->string('category')->default('general')->after('id');
        });

        // Update existing questions with appropriate categories
        DB::table('frequent_questions')->where('question', 'like', '%register%')->update(['category' => 'registration']);
        DB::table('frequent_questions')->where('question', 'like', '%ticket%')->update(['category' => 'registration']);
        DB::table('frequent_questions')->where('question', 'like', '%refund%')->update(['category' => 'registration']);
        DB::table('frequent_questions')->where('question', 'like', '%included%')->update(['category' => 'registration']);
        DB::table('frequent_questions')->where('question', 'like', '%speaker%')->update(['category' => 'programme']);
        DB::table('frequent_questions')->where('question', 'like', '%presentation%')->update(['category' => 'programme']);
        DB::table('frequent_questions')->where('question', 'like', '%recorded%')->update(['category' => 'programme']);
        DB::table('frequent_questions')->where('question', 'like', '%suggest%')->update(['category' => 'programme']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('frequent_questions', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
