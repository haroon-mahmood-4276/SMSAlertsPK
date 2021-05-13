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
                'user_id' => '00002',
                'group_id' => '00004',
                'section_id' => '00001',
                'code' => '00001',
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
                'is_active' => 'Y'
            ],
            [
                'user_id' => '00002',
                'group_id' => '00005',
                'section_id' => '00002',
                'code' => '00002',
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
                'is_active' => 'N'
            ],
            [
                'user_id' => '00002',
                'group_id' => '00006',
                'section_id' => '00001',
                'code' => '00003',
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
                'is_active' => 'Y'
            ],
        ]);
        DB::table('mobiledatas')->insert([
            [
                'user_id' => '00001',
                'group_id' => '00001',
                'code' => '00004',
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
                'is_active' => 'Y'
            ],
            [
                'user_id' => '00001',
                'group_id' => '00002',
                'code' => '00005',
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
                'is_active' => 'Y'
            ],

        ]);
    }
}
