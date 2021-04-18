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
                'id' => '00001',
                'first_name' => 'Haroon',
                'last_name' => 'Mahmood',
                'email' => 'haroon@abc.com',
                'password' => Hash::make('123456789'),
                'company_name' => 'ABC',
                'company_mask_id' => 'ABC',
                'company_nature' => 'B',
                'company_email' => 'haroon@abc.com',
                'mobile_1' => '923001234567',
                'mobile_2' =>  '923001234567',
                'remaining_of_sms' => 100,
                'no_of_sms' => 100,
            ],
            [
                'id' => '00002',
                'first_name' => 'Nasir',
                'last_name' => 'Mahmood',
                'email' => 'nasir@abc.com',
                'password' => Hash::make('123456789'),
                'company_name' => 'ABC1',
                'company_mask_id' => 'ABC1',
                'company_nature' => 'S',
                'company_email' => 'nasir@abc.com',
                'mobile_1' => '923001234567',
                'mobile_2' =>  '923001234567',
                'remaining_of_sms' => 150,
                'no_of_sms' => 150,
            ],
        ]);
    }
}
