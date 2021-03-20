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
                'user_id' => '2',
                'group_id' => '2',
                'section_id' => '1',
                'student_first_name' => 'Zain',
                'student_last_name' => 'Ejaz',
                'DOB' => '06/07/1998',
                'CNIC' => '35123-1234567-8',
                'Gender' => 'M',
                'student_mobile_1' => '923001234567',
                'student_mobile_2' => '',
                'parent_first_name' => 'Ejaz',
                'parent_last_name' => 'Ahmad',
                'parent_mobile_1' => '923001234567',
                'parent_mobile_2' => '',
            ],
            [
                'user_id' => '2',
                'group_id' => '2',
                'section_id' => '2',
                'student_first_name' => 'Ahsan',
                'student_last_name' => 'Ejaz',
                'DOB' => '06/07/1998',
                'CNIC' => '35123-1234567-8',
                'Gender' => 'M',
                'student_mobile_1' => '923001234567',
                'student_mobile_2' => '',
                'parent_first_name' => 'Ejaz',
                'parent_last_name' => 'Ahmad',
                'parent_mobile_1' => '923001234567',
                'parent_mobile_2' => '',
            ],
            [
                'user_id' => '2',
                'group_id' => '2',
                'section_id' => '1',
                'student_first_name' => 'Fahad',
                'student_last_name' => 'Bun Fraz',
                'DOB' => '06/07/1998',
                'CNIC' => '35123-1234567-8',
                'Gender' => 'M',
                'student_mobile_1' => '923001234567',
                'student_mobile_2' => '',
                'parent_first_name' => 'Fraz',
                'parent_last_name' => 'Gul',
                'parent_mobile_1' => '923001234567',
                'parent_mobile_2' => '',
            ],
        ]);
        DB::table('mobiledatas')->insert([
            [
                'user_id' => '1',
                'group_id' => '1',
                'student_first_name' => 'Haroon',
                'student_last_name' => 'Mahmood',
                'DOB' => '06/07/1999',
                'CNIC' => '35123-1234567-8',
                'Gender' => 'M',
                'student_mobile_1' => '923001234567',
                'student_mobile_2' => '',
                'parent_first_name' => 'Nasir',
                'parent_last_name' => 'Mahmood',
                'parent_mobile_1' => '923001234567',
                'parent_mobile_2' => '',
            ],
            [
                'user_id' => '1',
                'group_id' => '1',
                'student_first_name' => 'Abdullah',
                'student_last_name' => 'Qadri',
                'DOB' => '06/07/1998',
                'CNIC' => '35123-1234567-8',
                'Gender' => 'M',
                'student_mobile_1' => '923001234567',
                'student_mobile_2' => '',
                'parent_first_name' => 'Qadri',
                'parent_last_name' => 'Ahmad',
                'parent_mobile_1' => '923001234567',
                'parent_mobile_2' => '',
            ],

        ]);
    }
}
