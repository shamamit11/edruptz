<?php

namespace App\Http\Requests\Instructor;

use App\Http\Requests\WebRequest;

class PasswordRequest extends WebRequest
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
            'old_password' => 'required',
            'new_password' => 'required|min:8|different:old_password',
            'verify_password' => 'required|same:new_password',
        ];
    }
}
