<?php

namespace App\Http\Requests\Instructor;
use App\Http\Requests\WebRequest;

class LessonRequest extends WebRequest
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
            'id' => 'numeric|nullable',  
            'course_id' => 'required',
            'name' => 'required',
            'summary' => 'required',
            'description' => 'nullable',
            'assessment' => '',
            'old_assessment' => '',
            'file' => '',
            'old_file' => '',
            'video' => '',
            'old_video' => '',
            'lesson_number' => 'required|numeric',
        ];
    }
}
