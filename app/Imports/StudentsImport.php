<?php

namespace App\Imports;

use App\Models\{Group, Mobiledatas, Section};
use App\Rules\CheckMemberCode;
use App\Rules\IfExists;
use Maatwebsite\Excel\Concerns\{Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, ToModel, WithBatchInserts, WithHeadingRow, WithValidation};
use Illuminate\Support\Str;

class StudentsImport implements WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnError, SkipsOnFailure, ToModel
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        $Class_Id = Group::where('code', '=', Str::padLeft($row['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first()->id;
        $Section_Id = Section::where('user_id', '=', session('Data.id'))->where('group_id', '=', $Class_Id)->where('code', '=', Str::padLeft($row['section_id'], 5, '0'))->first()->id;
        return new Mobiledatas([
            'user_id' => session('Data.id'),
            'group_id' => $Class_Id,
            'section_id' => $Section_Id,
            'code' => $row['code'],
            'student_first_name' => $row['student_first_name'],
            'student_last_name' => $row['student_last_name'],
            'student_mobile_1' => $row['student_mobile_1'],
            'student_mobile_2' => $row['student_mobile_2'],
            'dob' => $row['dob'],
            // 'cnic' => $row['cnic'],
            'gender' => $row['gender'],
            'parent_first_name' => $row['parent_first_name'],
            'parent_last_name' => $row['parent_last_name'],
            'parent_mobile_1' => $row['parent_mobile_1'],
            'parent_mobile_2' => $row['parent_mobile_2'],
            'card_number' => $row['card_number'],
            'active' => $row['active'],
        ]);
        // return ;
    }

    public function rules(): array
    {
        return [
            'class_id' => [
                'bail',
                'required',
                'numeric',
                new IfExists(session('Data.id'), 'groups', 'code')
            ],
            'section_id' => [
                'bail',
                'required',
                'numeric',
                new IfExists(session('Data.id'), 'sections', 'code')
            ],
            'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new CheckMemberCode()],
        ];
    }

    public function batchSize(): int
    {
        return 500;
    }
}
