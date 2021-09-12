<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class IfExists implements Rule
{
    /**
   /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($Session_Id, $Table, $Column)
    {
        $this->Session_Id = $Session_Id;
        $this->Table = $Table;
        $this->Column = $Column;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return DB::table($this->Table)->where('user_id', '=', $this->Session_Id)->where($this->Column, '=', Str::padLeft($value, 5, '0'))->toSql();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This :attribute does not exists.';
    }
}
