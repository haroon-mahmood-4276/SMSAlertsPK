<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SectionsExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                '00001', '00001', 'sample section'
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
