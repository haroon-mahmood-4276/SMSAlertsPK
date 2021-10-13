<?php

namespace App\Rules;

use App\Models\Mobiledatas;
use App\Models\Section;
use Illuminate\Contracts\Validation\Rule;

class CheckMemberCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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

        $Data = Mobiledatas::where('user_id', '=', session('Data.id'))->where('code', '=', $value)->first();
        return ($Data == null);
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
