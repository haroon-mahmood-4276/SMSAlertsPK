<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToMobiledataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobiledatas', function (Blueprint $table) {
            $table->after('parent_mobile_2', function ($table) {
                $table->string('card_number', 20)->nullable();
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
        Schema::table('mobiledatas', function (Blueprint $table) {
            $table->dropIfExists('card_number');
        });
    }
}
