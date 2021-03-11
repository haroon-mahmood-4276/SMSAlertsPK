<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Groups extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'user_id' => '1',
                'name' => 'Clients',
            ],
            [
                'user_id' => '1',
                'name' => 'Stakeholders',
            ],
            [
                'user_id' => '1',
                'name' => 'Supplier',
            ],
            [
                'user_id' => '2',
                'name' => 'Class 1',
            ],
            [
                'user_id' => '2',
                'name' => 'Class 2',
            ], [
                'user_id' => '2',
                'name' => 'Class 3',
            ],
            [
                'user_id' => '2',
                'name' => 'Class 4',
            ],
            [
                'user_id' => '2',
                'name' => 'Class 5',
            ],
        ]);
    }
}
