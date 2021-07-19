<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                '00001',
                '00001',
                'first_name',
                'last_name',
                '923001234567',
                '923001234567',
                '06/07/1998',
                '35123-1234567-8',
                'M',
                'Y',
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'group_id',
            'code',
            'member_first_name',
            'member_last_name',
            'member_mobile_1',
            'member_mobile_2',
            'dob',
            'cnic',
            'gender',
            'active',
        ];
    }
}
