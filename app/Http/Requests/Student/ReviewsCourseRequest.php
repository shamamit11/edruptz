<?php

namespace App\Http\Requests\Student;
use App\Http\Requests\WebRequest;

class ReviewsCourseRequest extends WebRequest
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
            'course_id' => 'required|integer',
            'rating' => 'required',
            'description' => '',
        ];
    }
}
