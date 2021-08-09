<?php

namespace App\Rules\API;

use App\Models\Section;
use Illuminate\Contracts\Validation\Rule;

class SectionCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user_id, $group_code, $IsUpdate = false, $id = 0)
    {
        $this->user_id = $user_id;
        $this->IsUpdate = $IsUpdate;
        $this->id = $id;
        $this->group_code = $group_code;
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
            $Data = Section::where('user_id', '=',  $this->user_id)->where('group_id', '=', $this->group_code)->where('code', '=', $value)->get();
            if (!$Data->isEmpty()) {
                return true;
            }
        }
        $Data = Section::where('user_id', '=',  $this->user_id)->where('group_id', '=', $this->group_code)->where('code', '=', $value)->get();
        return $Data->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This section :attribute is already taken.';
    }
}
