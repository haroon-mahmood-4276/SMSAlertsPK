<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\{FromArray, WithHeadings};

class SubjectsExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                '00001', '00001', 'subject name'
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'class_id',
            'code',
            'name',
        ];
    }
}
