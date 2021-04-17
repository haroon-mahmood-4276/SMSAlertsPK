<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Templates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('templates')->insert([
            [
                'user_id' => '00001',
                'id' => '00002',
                'name' => 'Birthday',
                'template' => 'Blue',
            ],
        ]);
    }
}
