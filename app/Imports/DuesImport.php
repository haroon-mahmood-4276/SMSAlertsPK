<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DuesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return [
            'class_id'  => $row['class_id'],
            'section_id' => $row['section_id'],
            'code' => $row['code'],
            'dues' => $row['dues'],
        ];
    }
}
