<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class GroupsImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'code'     => $row[0],
            'name'    => $row[1],
        ]);
    }
}
