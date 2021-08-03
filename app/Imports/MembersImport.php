<?php

namespace App\Imports;


use App\Models\Group;
use App\Models\Mobiledatas;
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

    private $group_id = [], $group_code_index = 2;

    public function model(array $row)
    {
        // dd($this->section_id);
        return new Mobiledatas([
            'user_id' => session('Data.id'),
            'group_id' => $this->group_id[$this->group_code_index++],
            'section_id' => null,
            'code' => $row['code'],
            'student_first_name' => $row['member_first_name'],
            'student_last_name' => $row['member_last_name'],
            'student_mobile_1' => null,
            'student_mobile_2' => null,
            'dob' => $row['dob'],
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
            'code' => ['alpha_num', 'between:1,20', new CheckMemberCode()],
        ];
    }

    public function prepareForValidation($data, $index)
    {
        $this->group_id[$index] = Group::where('code', '=', Str::padLeft($data['group_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first()->id;
        // $data['code'] = Str::padLeft($data['code'], 5, '0');
        return $data;
    }

    public function batchSize(): int
    {
        return 500;
    }
}
