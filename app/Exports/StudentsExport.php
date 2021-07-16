<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                '00001',
                '00001',
                '00001',
                'first_name',
                'last_name',
                '923001234567',
                '923001234567',
                '06/07/1998',
                '35123-1234567-8',
                'M',
                'first_name',
                'last_name',
                '923001234567',
                '923001234567',
                'Y',
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'class_id',
            'section_id',
            'code',
            'student_first_name',
            'student_last_name',
            'student_mobile_1',
            'student_mobile_2',
            'dob',
            'cnic',
            'gender',
            'parent_first_name',
            'parent_last_name',
            'parent_mobile_1',
            'parent_mobile_2',
            'active',
        ];
    }
}
