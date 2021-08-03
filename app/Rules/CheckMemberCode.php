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
        // if ($this->IsUpdate) {
        //     $Data = Mobiledatas::where('user_id', '=', session('Data.id'))->where('group_id', '=', $this->group_id)->where('section_id', '=', $this->section_id)->where('code', '=', $value)->where('id', '=', $this->PKID)->get();
        //     // dd($Data);
        //     if (!$Data->isEmpty()) {
        //         return true;
        //     } else {
        //         $Data = Mobiledatas::where('user_id', '=', session('Data.id'))->where('group_id', '=', $this->group_id)->where('section_id', '=', $this->section_id)->where('code', '=', $value)->get();
        //         return $Data->isEmpty();
        //     }
        // } else {
            $Data = Mobiledatas::where('user_id', '=', session('Data.id'))->where('code', '=', $value)->get();
            return $Data->isEmpty();
        // }
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
