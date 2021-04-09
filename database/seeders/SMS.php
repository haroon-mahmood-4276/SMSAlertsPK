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
                'response' => 'Success',
            ],
            
        ]);
    }
}
