<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
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
            'token' => ['required'],
            'password' => ['required'],
            'password_confirmation' => ['required'],
            'hashCode' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'hashCode.required' => '入力制限回数を超えた等の理由で、このURLは使えません。確認コードの取得からやり直して下さい。',
        ];
    }

}
