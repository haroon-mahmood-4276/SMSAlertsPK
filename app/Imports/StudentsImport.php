<?php

namespace App\Imports;

use App\Models\{Group, Mobiledatas, Section};
use App\Rules\{IfGroupExist, IfSectionExist};
use Maatwebsite\Excel\Concerns\{
    Importable,
    SkipsErrors,
    SkipsFailures,
    SkipsOnError,
    SkipsOnFailure,
    ToModel,
    WithBatchInserts,
    WithHeadingRow,
    WithChunkReading,
    WithValidation
};
use Illuminate\Support\Str;

class StudentsImport implements WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnError, SkipsOnFailure, ToModel, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    private $group_id = [],  $index = 2;
    public function model(array $row)
    {
        // dd($this->group_id);
        $Class = Group::where('code', '=', Str::padLeft($row['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first();
        if ($Class) {
            $Section = Section::where('user_id', '=', session('Data.id'))->where('group_id', '=', $Class->id)->where('code', '=', Str::padLeft($row['section_id'], 5, '0'))->first();
            if ($Section) {
                return new Mobiledatas([
                    'user_id' => session('Data.id'),
                    'group_id' => $Class->id,
                    'section_id' => $Section->id,
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
        }
        return null;
    }


    public function rules(): array
    {
        return [
            'class_id' => ['bail', 'required', 'numeric', new IfGroupExist()],
            'section_id' => ['bail', 'required', 'numeric', new IfSectionExist($this->group_id[$this->index++])],
            'code' => ['bail', 'required', 'alpha_num', 'between:1,20', 'unique:mobiledatas,code'],
            'student_first_name' => 'bail|required|string|between:1,50',
            'student_last_name' => 'bail|nullable|string|between:1,50',
            'student_mobile_1' => 'bail|required|numeric|digits:12|unique:mobiledatas,student_mobile_1',
            'student_mobile_2' => 'bail|nullable|numeric|digits:12',
            'dob' => 'bail|nullable',
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
        $this->group_id[$index] = 0;
        if (Group::where('code', '=', Str::padLeft($data['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->exists()) {
            $this->group_id[$index] = Group::where('code', '=', Str::padLeft($data['class_id'], 5, '0'))->where('user_id', '=', session('Data.id'))->first()->id;
        }
        return $data;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
