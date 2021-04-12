<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SMS extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sms')->insert([
            [
                'user_id' => '1',
                'data_id' => '1',
                'sms' => 'Blue',
                'phone_number' => '923034243233',
                'response' => 'Success',
            ],

        ]);
    }
}