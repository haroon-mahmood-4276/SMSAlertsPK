<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MobileDatas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mobiledatas')->insert([
            [
                'user_id' => '1',
                'group_id' => '1',
                'section_id' => '1',
                'first_name' => 'Fahad',
                'last_name' => 'Bun Fraz',
                'parent_mobile_1' => '923001234567',
                'parent_mobile_2' => '',
                'student_mobile_1' => '923001234567',
                'student_mobile_2' => '',
            ]
        ]);
    }
}
