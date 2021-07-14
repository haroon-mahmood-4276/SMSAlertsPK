<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\Section;
use App\Rules\CheckSectionCode;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SectionsImport implements WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnError, SkipsOnFailure, ToModel
{
    use Importable, SkipsErrors, SkipsFailures;

    public $group_id = "";

    public function model(array $row)
    {
        $GroupID = Group::where('code', '=', Str::padLeft($row['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first();
        //  dd($GroupID);
        return new Section([
            'user_id' => session('Data.id'),
            'group_id' => $GroupID->id,
            'code' => Str::padLeft($row['code'], 5, '0'),
            'name' => $row['name'],
        ]);
    }

    public function rules(): array
    {
        return [
            'code' => ['numeric', new CheckSectionCode($this->group_id)],
        ];
    }

    public function prepareForValidation($data, $index)
    {
        $this->group_id = Str::padLeft($data['class_id'], 5, '0');
        return $data;
    }

    public function batchSize(): int
    {
        return 500;
    }
}
