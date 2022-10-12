<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\WebRequest;

class PageRequest extends WebRequest
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
            'title' => 'required',
            'sub_title' => '',
            'page_section_id' => 'required',
            'short_description' => '',
            'description' => '',
            'image' => 'image|mimes:jpeg,png,jpg,svg',
            'old_image' => '',
            'video' => '',
            'slug' => '',
            'header_menu' => '',
            'footer_menu' => '',
            'orders' => 'required|integer',
            'status' => 'nullable',
            'is_sitemap' => 'is_sitemap',
            'meta_title' => '',
            'meta_description' => '',
        ];
    }
}
