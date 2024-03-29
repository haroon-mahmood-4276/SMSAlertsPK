<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\{FromArray, WithHeadings};

class MembersExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                '00001',
                '1',
                'first_name',
                'last_name',
                '923001234567',
                '923001234567',
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
            'gender',
            'active',
        ];
    }
}
