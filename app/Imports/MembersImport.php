<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\Mobiledatas;
use App\Models\Section;
use App\Rules\CheckMemberCode;
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

class MembersImport implements WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnError, SkipsOnFailure, ToModel
{
    use Importable, SkipsErrors, SkipsFailures;

    private $group_id = [], $section_id = [], $Arrindex = 2;

    public function model(array $row)
    {
        return new Mobiledatas([
            'user_id' => session('Data.id'),
            'group_id' => Group::where('code', '=', Str::padLeft($row['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first()->id,
            'code' => $row['code'],
            'name' => $row['name'],
        ]);
    }

    public function rules(): array
    {
        return [
            'code' => ['numeric', new CheckMemberCode($this->group_id[$this->Arrindex++], $this->section_id[$this->Arrindex++])],
        ];
    }

    public function prepareForValidation($data, $index)
    {
        $this->group_id[$index] = Group::where('code', '=', Str::padLeft($data['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first()->id;
        $this->section_id[$index] = Section::where('code', '=', Str::padLeft($data['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first()->id;
        $data['code'] = Str::padLeft($data['code'], 5, '0');
        return $data;
    }

    public function batchSize(): int
    {
        return 500;
    }
}
