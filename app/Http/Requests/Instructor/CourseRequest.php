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
            'id' => 'numeric|nullable',
            'category_id' => 'required',
            'name' => 'required',
            'summary' => 'required',
            'description' => '',
            'image' => 'image|mimes:jpeg,png,jpg',
            'old_image' => '',
            'duration' => 'required',
            'amount' => 'required|numeric',
            'lectures' => 'required',
            'age_from' => 'required|numeric',
            'age_to' => 'required|numeric',
            'skill_id_1' => '',
            'percent_1' => '',
            'skill_id_2' => '',
            'percent_2' => '',
            'skill_id_3' => '',
            'percent_3' => '',
            'slug' => '',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'percent_1.required' => __('The percent field is required.'),
            'percent_1.integer' => __('The percent must be an integer.'),
            'percent_2.required' => __('The percent field is required.'),
            'percent_2.integer' => __('The percent must be an integer.'),
            'percent_3.required' => __('The percent field is required.'),
            'percent_3.integer' => __('The percent must be an integer.'),
        ];
    }
}
