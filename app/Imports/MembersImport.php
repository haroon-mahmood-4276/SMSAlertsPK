<?php

namespace App\Imports;


use App\Models\{Group, Mobiledatas};
use App\Rules\{CheckMemberCode, IfGroupExist};
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\{Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, ToModel, WithBatchInserts, WithHeadingRow, WithValidation};

class MembersImport implements WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnError, SkipsOnFailure, ToModel
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        // dd($this->section_id);
        return new Mobiledatas([
            'user_id' => session('Data.id'),
            'group_id' => Group::where('code', '=', Str::padLeft($row['group_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first()->id,
            'section_id' => null,
            'code' => $row['code'],
            'student_first_name' => $row['member_first_name'],
            'student_last_name' => $row['member_last_name'],
            'student_mobile_1' => null,
            'student_mobile_2' => null,
            'dob' => null,
            // 'cnic' => $row['cnic'],
            'gender' => $row['gender'],
            'parent_first_name' => null,
            'parent_last_name' => null,
            'parent_mobile_1' => $row['member_mobile_1'],
            'parent_mobile_2' => $row['member_mobile_2'],
            'active' => $row['active'],
        ]);
    }

    public function rules(): array
    {
        return [
            'class_id' => [
                'bail',
                'required',
                'numeric',
                new IfGroupExist(session('Data.id'), 'groups', 'code')
            ],
            'code' => ['alpha_num', 'between:1,20', new CheckMemberCode()],
        ];
    }

    public function batchSize(): int
    {
        return 500;
    }
}
