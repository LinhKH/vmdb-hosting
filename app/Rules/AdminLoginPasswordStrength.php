<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class AdminLoginPasswordStrength implements InvokableRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (!preg_match('/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,16}+\z/', $value)) {
            $fail(trans('validation.admin_login_password_strength'));
            return false;
        }
        return true;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.admin_login_password_strength');
    }
}
