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

    private $group_id = [], $section_id = [], $Arrindex = 2, $SaveIndex = 2;

    public function model(array $row)
    {
        return new Mobiledatas([
            'user_id' => session('Data.id'),
            'group_id' => $this->group_id[$this->SaveIndex++],
            'section_id' => $this->section_id[$this->SaveIndex++],
            'code' => $row['code'],
            'student_first_name' => $row['student_first_name'],
            'student_last_name' => $row['student_last_name'],
            'student_mobile_1' => $row['student_mobile_1'],
            'student_mobile_2' => $row['student_mobile_2'],
            'DOB' => $row['DOB'],
            'CNIC' => $row['CNIC'],
            'Gender' => $row['Gender'],
            'parent_first_name' => $row['parent_first_name'],
            'parent_last_name' => $row['parent_last_name'],
            'parent_mobile_1' => $row['parent_mobile_1'],
            'parent_mobile_2' => $row['parent_mobile_2'],
            'active' => $row['active'],
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
        $this->section_id[$index] = Section::where('user_id', '=', session('Data.id'))->where('group_id', '=', $this->group_id[$index])->where('code', '=', Str::padLeft($data['section_id'], 5, '0'))->first()->id;
        $data['code'] = Str::padLeft($data['code'], 5, '0');
        return $data;
    }

    public function batchSize(): int
    {
        return 500;
    }
}
