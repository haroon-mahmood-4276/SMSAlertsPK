<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'user_id' => '1',
                'birthday_enabled' => 'N',
                'birthday_message' => null,
                'primary_number_1' => 'Y',
                'primary_number_2' => null,
                'secondary_number_1' => null,
                'secondary_number_2' => null,
            ],
            [
                'user_id' => '2',
                'birthday_enabled' => 'N',
                'birthday_message' => null,
                'primary_number_1' => 'Y',
                'primary_number_2' => null,
                'secondary_number_1' => null,
                'secondary_number_2' => null,
            ],
        ]);
    }
}
