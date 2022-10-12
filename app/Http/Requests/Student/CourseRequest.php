<?php

namespace App\Http\Requests\Instructor;
use App\Http\Requests\WebRequest;

class CourseRequest extends WebRequest
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
            'category_id' => 'required',
            'name' => 'required',
            'summary' => 'required',
            'description' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg',
            'old_image' => '',
            'duration' => 'required',
            'amount' => 'required|numeric',
            'lectures' => 'required',
            'slug' => '',
        ];
    }
}
