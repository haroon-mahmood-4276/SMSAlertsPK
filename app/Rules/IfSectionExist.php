<?php

namespace App\Rules;

use App\Models\Section;
use Illuminate\Contracts\Validation\Rule;

class IfSectionExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($Session_Id, $Group_Id)
    {
        $this->Session_Id = $Session_Id;
        $this->Group_Id = $Group_Id;
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
        return Section::where('user_id', '=', session('Data.id'))->where('group_id', '=', $this->Group_Id)->where('code', '=', $value)->exists();
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
