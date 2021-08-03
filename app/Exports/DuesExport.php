<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DuesExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                '00001', 1500
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'student_code',
            'dues',
        ];
    }
}
