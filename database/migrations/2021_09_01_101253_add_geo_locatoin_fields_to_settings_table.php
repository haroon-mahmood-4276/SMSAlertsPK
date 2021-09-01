<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGeoLocatoinFieldsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->after('attendance_database_path', function ($table) {
                $table->string('geo_location_enabled', 1)->nullable();
                $table->double('longitude', 9, 6)->nullable();
                $table->double('latitude', 9, 6)->nullable();
                $table->double('raduis')->nullable();
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
            $table->dropIfExists([
                'geo_location_enabled', 'longitude', 'latitude', 'raduis'
            ]);
        });
    }
}
