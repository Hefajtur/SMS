<?php

namespace App\Http\Requests\academic;

use Illuminate\Foundation\Http\FormRequest;

class SubjectAssignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'class_id' => 'required',
            'section_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'class_id.required' => 'The class field is required!',
            'section_id.required' => 'The section field is required!',
        ];
    }
}
