<?php

namespace App\Rules\API;

use App\Models\Group;
use Illuminate\Contracts\Validation\Rule;

class GroupCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user_id, $IsUpdate = false, $id = 0)
    {
        $this->user_id = $user_id;
        $this->IsUpdate = $IsUpdate;
        $this->id = $id;
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
            $Data = Group::where('user_id', '=',  $this->user_id)->where('code', '=', $value)->where('id', '=', $this->id)->get();
            if (!$Data->isEmpty()) {
                return true;
            }
        }
        $Data = Group::where('user_id', '=',  $this->user_id)->where('code', '=', $value)->get();
        return $Data->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This :attribute is already taken.';
    }
}
