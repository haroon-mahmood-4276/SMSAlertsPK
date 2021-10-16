<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\{ToModel, WithHeadingRow};

class DuesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return [
            'code' => $row['student_code'],
            'dues' => $row['dues'],
        ];
    }
}
