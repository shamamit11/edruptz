<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\WebRequest;

class FaqRequest extends WebRequest
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
            'question' => 'required',
            'answer' => 'required',
            'orders' => 'integer',
            'types' => 'required',
            'status' => 'nullable',
        ];
    }
}
