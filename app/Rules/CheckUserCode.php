<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckUserCode implements Rule
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
        // dd($attribute ." - ".$value);
        if ($this->IsUpdate) {
            $Data = User::where('code', '=', $value)->where('id', '=', $this->PKID)->get();
            if (!$Data->isEmpty()) {
                return true;
            }
        }
        $Data = User::where('code', '=', $value)->get();
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
