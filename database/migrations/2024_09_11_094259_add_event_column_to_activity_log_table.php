<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventColumnToActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->string('event')->nullable()->after('subject_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->dropColumn('event');
        });
    }
}
