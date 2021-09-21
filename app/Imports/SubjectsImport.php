<?php

namespace App\Imports;

use App\Models\{Group, Subject};
use App\Rules\{CheckSubjectRule, IfGroupExist};
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\{
    Importable,
    SkipsErrors,
    SkipsFailures,
    SkipsOnError,
    SkipsOnFailure,
    ToModel,
    WithBatchInserts,
    WithHeadingRow,
    WithValidation
};

class SubjectsImport implements WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnError, SkipsOnFailure, ToModel
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        return new Subject([
            'user_id' => session('Data.id'),
            'group_id' => Group::where('code', '=', Str::padLeft($row['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first()->id,
            'code' => Str::padLeft($row['code'], 5, '0'),
            'name' => $row['name'],
        ]);
    }

    public function rules(): array
    {
        return [
            'class_id' => ['bail', 'required', 'numeric', new IfGroupExist(session('Data.id'))],
            'code' => ['numeric', new CheckSubjectRule()],
            'name' => 'bail|required|between:1,50',
        ];
    }

    public function batchSize(): int
    {
        return 500;
    }
}
