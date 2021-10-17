<?php

namespace App\Imports;

use App\Models\{Group, Section};
use App\Rules\{CheckSectionCode, IfGroupExist};
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\{Importable, SkipsErrors, SkipsFailures, SkipsOnError, SkipsOnFailure, ToModel, WithBatchInserts, WithHeadingRow, WithValidation, WithChunkReading};

class SectionsImport implements WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnError, SkipsOnFailure, ToModel, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    private $group_id = [], $Arrindex = 2, $SaveIndex = 2;
    protected $UserID;
    public function  __construct($UserID)
    {
        $this->UserID = $UserID;
    }
    public function model(array $row)
    {
        return new Section([
            'user_id' => $this->UserID,
            'group_id' => $this->group_id[$this->SaveIndex++],
            'code' => Str::padLeft($row['code'], 5, '0'),
            'name' => $row['name'],
        ]);
    }

    public function rules(): array
    {
        return [
            'class_id' => ['bail', 'required', 'numeric', new IfGroupExist(session('Data.id'))],
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckSectionCode($this->group_id[$this->Arrindex++])],
            'name' => 'bail|required|between:1,50',
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
