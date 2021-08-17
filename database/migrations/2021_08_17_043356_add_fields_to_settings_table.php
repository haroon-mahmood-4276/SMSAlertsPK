<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->after('student_secondary_number', function ($table) {
                $table->string('attendance_message')->nullable();
                $table->string('attendance_enabled', 1)->nullable();
                $table->string('attendance_parent_primary_number', 1)->nullable();
                $table->string('attendance_parent_secondary_number', 1)->nullable();
                $table->string('attendance_student_primary_number', 1)->nullable();
                $table->string('attendance_student_secondary_number', 1)->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('attendance_message');
            $table->dropColumn('attendance_enabled');
            $table->dropColumn('attendance_parent_primary_number');
            $table->dropColumn('attendance_parent_secondary_number');
            $table->dropColumn('attendance_student_primary_number');
            $table->dropColumn('attendance_student_secondary_number');
        });
    }
}
