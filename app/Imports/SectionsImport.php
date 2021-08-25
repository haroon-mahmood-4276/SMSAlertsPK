<?php

namespace App\Imports;

use App\Models\{Group, Section};
use App\Rules\CheckSectionCode;
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

class SectionsImport implements WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnError, SkipsOnFailure, ToModel
{
    use Importable, SkipsErrors, SkipsFailures;

    private $group_id = [], $Arrindex = 2, $SaveIndex = 2;

    public function model(array $row)
    {
        return new Section([
            'user_id' => session('Data.id'),
            'group_id' => $this->group_id[$this->SaveIndex++],
            'code' => $row['code'],
            'name' => $row['name'],
        ]);
    }

    public function rules(): array
    {
        return [
            'code' => ['numeric', new CheckSectionCode($this->group_id[$this->Arrindex++])],
        ];
    }

    public function prepareForValidation($data, $index)
    {
        // dd(Group::where('code', '=', Str::padLeft($data['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first()->id);
        $this->group_id[$index] = Group::where('code', '=', Str::padLeft($data['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first()->id;
        $data['code'] = Str::padLeft($data['code'], 5, '0');
        return $data;
    }

    public function batchSize(): int
    {
        return 500;
    }
}
