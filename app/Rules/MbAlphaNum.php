<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class MbAlphaNum implements InvokableRule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function __invoke($attribute, $value, $fail)
    {
        if ($value === null || $value === '') {
            return true;
        }

        if(preg_match('/^[0-9a-zA-Z]+$/', $value) === 1){
            return true;
        }else{
            $fail(trans('validation.mb_alpha_num'));
            return false;
        }
    }

}
