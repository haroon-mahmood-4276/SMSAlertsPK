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
                'parent_secondary_number' => 'N',
                'student_primary_number' => 'N',
                'student_secondary_number' => 'N',
                'attendance_enabled' => 'N',
                'attendance_message' => null,
                'attendance_parent_primary_number' => 'N',
                'attendance_parent_secondary_number' => 'N',
                'attendance_database_path_enabled' => 'N',
                'attendance_database_path' => null,
                'longitude' => 0,
                'latitude' => 0,
                'raduis' => 0,
            ],
            [
                'user_id' => '2',
                'birthday_enabled' => 'N',
                'birthday_message' => null,
                'parent_primary_number' => 'Y',
                'parent_secondary_number' => 'N',
                'student_primary_number' => 'N',
                'student_secondary_number' => 'N',
                'attendance_enabled' => 'N',
                'attendance_message' => null,
                'attendance_parent_primary_number' => 'N',
                'attendance_parent_secondary_number' => 'N',
                'attendance_database_path_enabled' => 'N',
                'attendance_database_path' => null,
                'longitude' => 0,
                'latitude' => 0,
                'raduis' => 0,
            ], [
                'user_id' => '3',
                'birthday_enabled' => 'N',
                'birthday_message' => null,
                'parent_primary_number' => 'Y',
                'parent_secondary_number' => 'N',
                'student_primary_number' => 'N',
                'student_secondary_number' => 'N',
                'attendance_enabled' => 'N',
                'attendance_message' => null,
                'attendance_parent_primary_number' => 'N',
                'attendance_parent_secondary_number' => 'N',
                'attendance_database_path_enabled' => 'N',
                'attendance_database_path' => null,
                'longitude' => 0,
                'latitude' => 0,
                'raduis' => 0,
            ],
        ]);
    }
}
