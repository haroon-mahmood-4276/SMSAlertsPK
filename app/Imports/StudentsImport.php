<?php

namespace App\Imports;

use App\Models\{Group, Mobiledatas, Section};
use App\Rules\{CheckMemberCode, IfExists};
use Maatwebsite\Excel\Concerns\{Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, ToModel, WithBatchInserts, WithHeadingRow, WithValidation};
use Illuminate\Support\Str;

class StudentsImport implements WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnError, SkipsOnFailure, ToModel
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        $Class_Id = Group::where('code', '=', Str::padLeft($row['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first();
        $Section_Id = Section::where('user_id', '=', session('Data.id'))->where('group_id', '=', $Class_Id->id)->where('code', '=', Str::padLeft($row['section_id'], 5, '0'))->first();
        return new Mobiledatas([
            'user_id' => session('Data.id'),
            'group_id' => $Class_Id->id,
            'section_id' => $Section_Id->id,
            'code' => $row['code'],
            'student_first_name' => $row['student_first_name'],
            'student_last_name' => $row['student_last_name'],
            'student_mobile_1' => $row['student_mobile_1'],
            'student_mobile_2' => $row['student_mobile_2'],
            'dob' => $row['dob'],
            'gender' => $row['gender'],
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
            'class_id' => ['bail', 'required', 'numeric', 'exists:groups,code'],
            'section_id' => ['bail', 'required', 'numeric', 'exists:sections,code,class_id'],
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

    public function batchSize(): int
    {
        return 700;
    }
}
