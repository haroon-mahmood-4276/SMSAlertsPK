<?php

namespace App\Rules;

use App\Models\Teacher;
use Illuminate\Contracts\Validation\Rule;

class CheckTeacherCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user_id, $group_id, $IsUpdate = false, $PKID = 0)
    {
        $this->user_id = $user_id;
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
            $Data = Teacher::where('user_id', '=', $this->user_id)->where('code', '=', $value)->where('id', '=', $this->PKID)->get();
            return !$Data->isEmpty();
        }
        $Data = Teacher::where('user_id', '=', $this->user_id)->where('code', '=', $value)->get();
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
