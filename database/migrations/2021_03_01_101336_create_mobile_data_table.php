<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMobileDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobiledatas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->id();
            $table->string('student_first_name', 50);
            $table->string('student_last_name', 50);
            $table->string('student_mobile_1');
            $table->string('student_mobile_2')->nullable();
            $table->string('DOB', 10);
            $table->string('CNIC', 15);
            $table->string('Gender', 1);
            $table->string('parent_first_name', 50);
            $table->string('parent_last_name', 50);
            $table->string('parent_mobile_1');
            $table->string('parent_mobile_2')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('section_id')->references('id')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobiledatas');
    }
}
