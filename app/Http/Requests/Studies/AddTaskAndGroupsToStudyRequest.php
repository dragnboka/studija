<?php

namespace App\Http\Requests\Studies;

use Illuminate\Foundation\Http\FormRequest;

class AddTaskAndGroupsToStudyRequest extends FormRequest
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
            'tasks.*' => 'nullable|string|max:200',
            'groups.*' => 'nullable|string|max:200',
        ];
    }

}