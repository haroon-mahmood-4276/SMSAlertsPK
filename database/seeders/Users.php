<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Haroon',
                'last_name' => 'Mahmood',
                'email' => 'abc@abc.com',
                'password' => Hash::make('123456789'),
            ]
        ]);
    }
}
