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
            ],
            [
                'user_id' => '2',
                'birthday_enabled' => 'N',
                'birthday_message' => null,
            ],
        ]);
    }
}
