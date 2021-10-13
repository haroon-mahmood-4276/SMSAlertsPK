<?php

namespace App\Rules;

use App\Models\Group;
use Illuminate\Contracts\Validation\Rule;

class CheckGroupCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($IsUpdate = false, $PKID = 0)
    {
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
            $Data = Group::where('user_id', '=', session('Data.id'))->where('code', '=', $value)->where('id', '=', $this->PKID)->first();
            if ($Data) {
                return !($Data == null);
            }
        }
        $Data = Group::where('user_id', '=', session('Data.id'))->where('code', '=', $value)->first();
        return ($Data == null);
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
