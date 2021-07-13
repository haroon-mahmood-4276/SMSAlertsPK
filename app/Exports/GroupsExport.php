<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GroupsExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                '00001', 'sample'
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'code',
            'name',
        ];
    }
}
