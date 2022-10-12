<?php

namespace App\Http\Requests\Site;

use App\Http\Requests\WebRequest;

class RegisterRequest extends WebRequest
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
            'name' => 'required',
            'email' => ($this->user_type) ? 'required|email|unique:instructors' : '',
            'password' => [
                'required',
                'string',
                'min:8', // must be at least 8 characters in length
               // 'regex:/[a-z]/', // must contain at least one lowercase letter
               // 'regex:/[A-Z]/', // must contain at least one uppercase letter
              //  'regex:/[0-9]/', // must contain at least one digit
              //  'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'verify' => 'required|same:password',
            'user_type' => 'sometimes',

        ];
    }
}
