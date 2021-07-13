<?php

namespace App\Imports;

use App\Models\Group;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GroupsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Group([
            'user_id' => session('Data.id'),
            'code' => Str::padLeft($row['code'], 5, '0'),
            'name' => $row['name'],
        ]);
    }
}
