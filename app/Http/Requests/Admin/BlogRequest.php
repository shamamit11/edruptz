<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\WebRequest;

class BlogRequest extends WebRequest
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
            'date' => 'required',
            'name' => 'required',
            'short_description' => 'required',
            'description' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg',
            'old_image' => '',
            'status' => 'nullable',
            'slug' => '',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
        ];
    }
}
