<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Sections extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            [
                'user_id' => '00002',
                'id' => '00001',
                'group_id' => '00004',
                'name' => 'Blue',
            ],
            [
                'user_id' => '00002',
                'id' => '00002',
                'group_id' => '00005',
                'name' => 'Green',
            ],
            [
                'user_id' => '00002',
                'id' => '00003',
                'group_id' => '00006',
                'name' => 'Red',
            ],
            [
                'user_id' => '00002',
                'id' => '00004',
                'group_id' => '00007',
                'name' => 'Yellow',
            ],
            [
                'user_id' => '00002',
                'id' => '00005',
                'group_id' => '00008',
                'name' => 'Cyan',
            ]
        ]);
    }
}
