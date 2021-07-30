<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Setting', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->id();
            $table->string('birthday_message')->nullable();
            $table->string('birthday_enabled', 1)->nullable();
            $table->string('primary_number_1', 1)->nullable();
            $table->string('primary_number_2', 1)->nullable();
            $table->string('secondary_number_1', 1)->nullable();
            $table->string('secondary_number_2', 1)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
