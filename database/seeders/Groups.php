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
                'user_id' => '00001',
                'id' => '00001',
                'name' => 'Clients',
            ],
            [
                'user_id' => '00001',
                'id' => '00002',
                'name' => 'Stakeholders',
            ],
            [
                'user_id' => '00001',
                'id' => '00003',
                'name' => 'Supplier',
            ],
            [
                'user_id' => '00002',
                'id' => '00004',
                'name' => 'Class 1',
            ],
            [
                'user_id' => '00002',
                'id' => '00005',
                'name' => 'Class 2',
            ], [
                'user_id' => '00002',
                'id' => '00006',
                'name' => 'Class 3',
            ],
            [
                'user_id' => '00002',
                'id' => '00007',
                'name' => 'Class 4',
            ],
            [
                'user_id' => '00002',
                'id' => '00008',
                'name' => 'Class 5',
            ],
        ]);
    }
}
