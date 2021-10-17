<?php

namespace App\Imports;

use App\Models\Group;
use App\Rules\CheckGroupCode;
use Maatwebsite\Excel\Concerns\{
    ToModel,
    Importable,
    WithChunkReading,
    WithHeadingRow,
    WithBatchInserts,
    SkipsErrors,
    SkipsFailures,
    SkipsOnError,
    SkipsOnFailure,
    WithValidation,
};
use Illuminate\Support\Str;

class GroupsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure, WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    protected $UserID;
    public function  __construct($UserID)
    {
        $this->UserID = $UserID;
    }

    public function model(array $row)
    {
        return new Group([
            'user_id' => $this->UserID,
            'code' => Str::padLeft($row['code'], 5, '0'),
            'name' => $row['name'],
        ]);
    }

    public function rules(): array
    {
        return [
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckGroupCode()],
            'name' => 'bail|required|between:1,50',
        ];
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
