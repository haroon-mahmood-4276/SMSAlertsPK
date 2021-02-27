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
                'company_name' => 'ABC',
                'company_mask_id' => 'ABC',
                'company_nature'=>'A',
                'company_email' => 'abc@abc.com',
                'mobile_1' => '923001234567',
                'mobile_2' =>  '923001234567',
                'no_of_sms' => 0,
            ]
        ]);
    }
}
