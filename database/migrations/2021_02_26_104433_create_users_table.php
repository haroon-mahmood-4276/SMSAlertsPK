<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5)->nullable();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('company_username')->nullable();
            $table->string('company_password')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_mask_id', 30)->nullable();
            $table->char('company_nature',5)->nullable();
            $table->string('company_email')->unique();
            $table->string('mobile_1')->nullable();
            $table->string('mobile_2')->nullable();
            $table->integer('remaining_of_sms')->nullable();
            $table->integer('no_of_sms')->nullable();
            $table->date('expiry_date')->nullable();
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
        Schema::dropIfExists('users');
    }
}
