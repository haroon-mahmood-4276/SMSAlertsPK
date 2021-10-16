<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStudentTeacherSubjectJunctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_teacher_subject_junction', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
            $table->foreignId('mobiledata_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->id();
            $table->date('today_date');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_teacher_subject_junction');
    }
}
