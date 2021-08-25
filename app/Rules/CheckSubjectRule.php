<?php

namespace App\Rules;

use App\Models\Subject;
use Illuminate\Contracts\Validation\Rule;

class CheckSubjectRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($group_id,$IsUpdate = false, $PKID = 0)
    {
        $this->group_id = $group_id;
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
            $Data = Subject::where('user_id', '=', session('Data.id'))->where('group_id', '=', $this->group_id)->where('section_id', '=', $this->section_id)->where('code', '=', $value)->where('id', '=', $this->PKID)->get();
            // dd($Data);
            if (!$Data->isEmpty()) {
                return true;
            }
        }
        $Data = Subject::where('user_id', '=', session('Data.id'))->where('group_id', '=', $this->group_id)->where('section_id', '=', $this->section_id)->where('code', '=', $value)->get();
        return $Data->isEmpty();
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
