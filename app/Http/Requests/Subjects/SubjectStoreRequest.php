<?php

namespace App\Http\Requests\Subjects;

use Illuminate\Foundation\Http\FormRequest;

class SubjectStoreRequest extends FormRequest
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
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'middleName'  => 'required|string',
            'dob'  => 'required|date_format:"Y-m-d"',
            'gender'  => 'required',
            'studies' => 'required|filled',
            'groups' => 'required',
        ];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function messages()
    {
        return [
            'studies.required' => 'You must select one study',
            'groups.required'  => 'You must select one group',
        ];
    }
}