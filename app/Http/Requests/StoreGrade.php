<?php


// Here we make the form validation from request we recive then pass it back to the controller



namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrade extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // need to be true
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
        'Name' => 'required',
        'Notes'=> 'nullable',
        ];
    }
    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'body.required' => 'A message is required',
        ];
    }

}