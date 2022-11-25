<?php

namespace App\Http\Requests\Student;
use App\Http\Requests\WebRequest;

class ProfileRequest extends WebRequest
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
            'id' => 'integer|nullable',  
            'name' => 'required',
            'last_name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'old_image' => '',
            'country' => 'required',
            'city' => '',
            'state' => '',
            'zip' => '',
        ];
    }
}
