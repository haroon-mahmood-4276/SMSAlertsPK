<?php

namespace App\Imports;

use App\Models\Group;
use App\Rules\CheckGroupCode;
use Maatwebsite\Excel\Concerns\{
    ToModel,
    Importable,
    SkipsErrors,
    SkipsFailures,
    SkipsOnError,
    SkipsOnFailure,
    WithBatchInserts,
    WithHeadingRow,
    WithValidation
};
use Illuminate\Support\Str;

class GroupsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure, WithBatchInserts
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        return new Group([
            'user_id' => session('Data.id'),
            'code' => Str::padLeft($row['code'], 5, '0'),
            'name' => $row['name'],
        ]);
    }

    public function rules(): array
    {
        return [
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckGroupCode()],
            'name' => 'bail|required|between:1,50',
        ];
    }

    public function batchSize(): int
    {
        return 500;
    }
}
