<?php

namespace App\Http\Requests\Site;
use App\Http\Requests\WebRequest;

class ResetPasswordRequest extends WebRequest
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
            'token' => 'required|exists:password_resets,token',
			'password' => [
                'required',
                'string',
                'min:8', // must be at least 8 characters in length
               'regex:/[a-z]/', // must contain at least one lowercase letter
               'regex:/[A-Z]/', // must contain at least one uppercase letter
               'regex:/[0-9]/', // must contain at least one digit
               'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'verify' => 'required|same:password',
        ];
    }
	
	public function messages()
    {
        return [
            'password' => __('At least 8 characters with 1 Uppercase, 1 Number and 1 character'),
            'verify' => __('Password does not match'),
        ];
    }
}
