<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class PasswordStrength implements InvokableRule
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
        if (preg_match('/^([0-9a-z]{1})\1+$/i', $value)) {
            $fail(trans('validation.password_strength'));
            return false;
        } else {
            return true;
        }
    }
}
