<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\WebRequest;

class SettingRequest extends WebRequest
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
            'site_name' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'google_analytics' => '',
            'google_site_verification' => '',
            'email' => 'required',
            'instructor_email' => 'required',
            'student_email' => 'required',
            'support_email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'years' => '', 
            'map' => '', 
        ];
    }
}
