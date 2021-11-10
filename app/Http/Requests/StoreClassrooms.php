<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreClassrooms extends FormRequest
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
        // dont forget ur using data-repeater-list in the blade,
        // so we need to type the name field this way
        return [
        'List_Classes.*.Name' => 'required',
        'List_Classes.*.Name_class_en' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'Name_class_en.required' => trans('validation.required'),
        ];
    }
}
