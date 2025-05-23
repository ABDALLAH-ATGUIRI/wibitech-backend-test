<?php

namespace App\Http\Requests\User;

use App\Http\Requests\RequestBase;

class LoginRequest extends RequestBase
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
            'username' => 'required|max:250|exists:users,username',
            'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'
        ];
    }

    /**
     * Summary of messages
     * @return string[]
     */
    public function messages()
    {
        return [
            'username.required' => 'The email field is required.',
            'username.exists' => 'The email is not registered.',
            'password.required' => 'The password field is required.',
        ];
    }
}
