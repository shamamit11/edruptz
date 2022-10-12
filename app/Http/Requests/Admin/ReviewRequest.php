<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\WebRequest;

class ReviewRequest extends WebRequest
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
            'designation' => 'nullable',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'old_image' => '',
            'status' => 'nullable',
        ];
    }
}
