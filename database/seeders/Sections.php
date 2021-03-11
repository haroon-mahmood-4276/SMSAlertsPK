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
                'user_id' => '2',
                'group_id' => '4',
                'name' => 'Blue',
            ],
            [
                'user_id' => '2',
                'group_id' => '5',
                'name' => 'Green',
            ],
            [
                'user_id' => '2',
                'group_id' => '6',
                'name' => 'Red',
            ],
            [
                'user_id' => '2',
                'group_id' => '7',
                'name' => 'Yellow',
            ],
            [
                'user_id' => '2',
                'group_id' => '8',
                'name' => 'Cyan',
            ]
        ]);
    }
}
