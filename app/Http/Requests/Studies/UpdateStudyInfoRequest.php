<?php

namespace App\Http\Requests\Studies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudyInfoRequest extends FormRequest
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
            'name' => 'required|string',
            'tasks.*' => 'required',
            'groups.*' => 'required',
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
            'tasks.*.required' => 'Task field can not be empty',
            'groups.*.required' => 'Group field can not be empty',
        ];
    }
}