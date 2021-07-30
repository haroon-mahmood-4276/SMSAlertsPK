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
                'parent_primary_number' => 'Y',
                'parent_secondary_number' => null,
                'student_primary_number' => null,
                'student_secondary_number' => null,
            ],
            [
                'user_id' => '2',
                'birthday_enabled' => 'N',
                'birthday_message' => null,
                'parent_primary_number' => 'Y',
                'parent_secondary_number' => null,
                'student_primary_number' => null,
                'student_secondary_number' => null,
            ],
        ]);
    }
}
