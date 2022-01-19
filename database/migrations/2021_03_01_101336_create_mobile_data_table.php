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
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('group_id')->nullable()->constrained();
            $table->foreignId('section_id')->nullable()->constrained();
            $table->id();
            $table->string('code', 20);
            $table->string('student_first_name', 50)->nullable();
            $table->string('student_last_name', 50)->nullable();
            $table->string('student_mobile_1', 12)->nullable();
            $table->string('student_mobile_2', 12)->nullable();
            $table->date('dob')->nullable();
            $table->string('gender', 1)->nullable();
            $table->string('parent_first_name', 50)->nullable();
            $table->string('parent_last_name', 50)->nullable();
            $table->string('parent_mobile_1', 12);
            $table->string('parent_mobile_2', 12)->nullable();
            $table->string('active', 1);
            $table->timestamps();
            $table->softDeletes();
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
