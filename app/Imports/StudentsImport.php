<?php

namespace App\Imports;

use App\Models\{Group, Mobiledatas, Section};
use App\Rules\{CheckMemberCode, IfGroupExist, IfSectionExist};
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\{Importable, SkipsErrors, SkipsFailures, SkipsOnError, OnEachRow, SkipsOnFailure, ToModel, WithBatchInserts, WithHeadingRow, WithValidation, ToCollection};
use Illuminate\Support\Str;
use Maatwebsite\Excel\Row;

class StudentsImport implements WithHeadingRow, ToModel, WithValidation
{
    use Importable, SkipsFailures;

    private $Group_Ids = [], $Arrindex = 2, $SaveIndex = 2;
    public function model(array $row)
    {
        $Class_Id = Group::where('code', '=', Str::padLeft($row['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first()->id;
        $Section_Id = Section::where('user_id', '=', session('Data.id'))->where('group_id', '=', $Class_Id->id)->where('code', '=', Str::padLeft($row['section_id'], 5, '0'))->first()->id;
        return new Mobiledatas([
            'user_id' => session('Data.id'),
            'group_id' => $Class_Id->id,
            'section_id' => $Section_Id->id,
            'code' => $row['code'],
            'student_first_name' => $row['student_first_name'],
            'student_last_name' => $row['student_last_name'],
            'student_mobile_1' => $row['student_mobile_1'],
            'dob' => $row['dob'],
            'gender' => $row['gender'],
            'student_mobile_2' => $row['student_mobile_2'],
            'parent_first_name' => $row['parent_first_name'],
            'parent_last_name' => $row['parent_last_name'],
            'parent_mobile_1' => $row['parent_mobile_1'],
            'parent_mobile_2' => $row['parent_mobile_2'],
            'card_number' => $row['card_number'],
            'active' => $row['active'],
        ]);
    }


    public function rules(): array
    {
        return [
            'class_id' => ['bail', 'required', 'numeric', new IfGroupExist(session('Data.id'))],
            'section_id' => ['bail', 'required', 'numeric', new IfSectionExist(session('Data.id'), '')],
            'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new CheckMemberCode()],
            'student_first_name' => 'bail|required|string|between:1,50',
            'student_last_name' => 'bail|nullable|string|between:1,50',
            'student_mobile_1' => 'bail|required|numeric|digits:12|unique:mobiledatas,student_mobile_1',
            'student_mobile_2' => 'bail|nullable|numeric|digits:12',
            'dob' => 'bail|nullable|date',
            'gender' => 'required',
            'parent_first_name' => 'bail|required|string|between:1,50',
            'parent_last_name' => 'bail|nullable|string|between:1,50',
            'parent_mobile_1' => 'required|numeric|digits:12',
            'parent_mobile_2' => 'nullable|numeric|digits:12',
            'active' => 'required',
        ];
    }

    public function prepareForValidation($data, $index)
    {

        return $data;
    }

    public function batchSize(): int
    {
        return 700;
    }
}
