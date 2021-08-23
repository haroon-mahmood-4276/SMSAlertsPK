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
                'code' => '00001',
                'first_name' => 'Business',
                'last_name' => 'SmsAlertsPK',
                'email' => 'business@smsalertspk.com',
                'password' => Hash::make('123456789'),
                'company_username' => 'test',
                'company_password' => '123456',
                'company_name' => 'ABC',
                'company_mask_id' => 'ALERTS',
                'company_nature' => 'B',
                'company_email' => 'business@smsalertspk.com',
                'mobile_1' => '923001234567',
                'mobile_2' =>  '923001234567',
                'remaining_of_sms' => 100,
                'no_of_sms' => 100,
                'expiry_date' => '2021-09-25',
            ],
            [
                'code' => '00002',
                'first_name' => 'School',
                'last_name' => 'SmsAlertsPk',
                'email' => 'school@smsalertspk.com',
                'password' => Hash::make('123456789'),
                'company_username' => 'test',
                'company_password' => '123456',
                'company_name' => 'ABC1',
                'company_mask_id' => 'ALERTS',
                'company_nature' => 'S',
                'company_email' => 'school@smsalertspk.com',
                'mobile_1' => '923001234567',
                'mobile_2' =>  '923001234567',
                'remaining_of_sms' => 150,
                'no_of_sms' => 150,
                'expiry_date' => '2021-09-25',
            ], [
                'code' => '00003',
                'first_name' => 'Higher',
                'last_name' => 'Education',
                'email' => 'highereducation@smsalertspk.com',
                'password' => Hash::make('123456789'),
                'company_username' => 'test',
                'company_password' => '123456',
                'company_name' => 'ABC2',
                'company_mask_id' => 'ALERTS',
                'company_nature' => 'HE',
                'company_email' => 'highereducation@smsalertspk.com',
                'mobile_1' => '923001234567',
                'mobile_2' =>  '923001234567',
                'remaining_of_sms' => 150,
                'no_of_sms' => 150,
                'expiry_date' => '2021-09-25',
            ],
            [
                'code' => '00000',
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@smsalertspk.com',
                'password' => Hash::make('123456789'),
                'company_username' => null,
                'company_password' => null,
                'company_name' => null,
                'company_mask_id' => null,
                'company_nature' => 'A',
                'company_email' => 'admin@smsalertspk.com',
                'mobile_1' => null,
                'mobile_2' =>  null,
                'remaining_of_sms' => 0,
                'no_of_sms' => 0,
                'expiry_date' => null,
            ],
        ]);
    }
}
