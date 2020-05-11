<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CNIC implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        ///^[1-9][0-9]{12}$/' ,                               //3520277881458
        /// regex:/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/' ,         //35202-7788145-8
        return preg_match("/^[1-9][0-9+]{4}-?[0-9+]{7}-?[0-9]{1}$/", $value);
        //35202-7788145-8 and 352027788145-8 and 35202-77881458
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute must be a valid CNIC Start with 1-9 e.g. 1111-11111111-1 , 111111111111-1 , 1111-111111111 ,  1111111111111';
    }
}
