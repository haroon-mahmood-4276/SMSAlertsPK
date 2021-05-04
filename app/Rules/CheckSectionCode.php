<?php

namespace App\Rules;

use App\Models\Section;
use Illuminate\Contracts\Validation\Rule;

class CheckSectionCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($group_code, $IsUpdate = false, $PKID = 0)
    {
        $this->group_code = $group_code;
        $this->IsUpdate = $IsUpdate;
        $this->PKID = $PKID;
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
        if ($this->IsUpdate) {
            $Data = Section::where('user_id', '=', session('Data.id'))->where('group_id', '=', $this->group_code)->where('code', '=', $value)->where('id', '=', $this->PKID)->get();
            // dd($Data);
            if (!$Data->isEmpty()) {
                return true;
            } else {
                $Data = Section::where('user_id', '=', session('Data.id'))->where('group_id', '=', $this->group_code)->where('code', '=', $value)->get();
                return $Data->isEmpty();
            }
        } else {
            $Data = Section::where('user_id', '=', session('Data.id'))->where('group_id', '=', $this->group_code)->where('code', '=', $value)->get();
            return $Data->isEmpty();
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This :attribute is taken.';
    }
}
