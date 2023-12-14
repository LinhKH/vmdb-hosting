<?php

namespace App\Http\Requests;

use App\Models\TAdmin;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MbAlphaNum;

class Forgot extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login_id' => ['required','string',new MbAlphaNum,'max:'.TAdmin::MAX_LOGIN_ID_LENGTH],
        ];
    }


    public function attributes(): array
    {
        return [
            'login_id' => 'ログインID',
        ];
    }
}
