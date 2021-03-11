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
                'group_id' => '1',
                'name' => 'Blue',
            ],
            [
                'user_id' => '2',
                'group_id' => '2',
                'name' => 'Green',
            ],
            [
                'user_id' => '2',
                'group_id' => '3',
                'name' => 'Red',
            ],
            [
                'user_id' => '2',
                'group_id' => '2',
                'name' => 'Yellow',
            ]
        ]);
    }
}
