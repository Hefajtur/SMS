<?php

namespace App\Http\Requests\fees;

use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
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
            'group_id' => 'required|max:255',
            'class_id' => 'required|max:255',
            'master_id' => 'required|max:255',
            'section_id' => 'required|max:255',
            'gender' => 'required',
            'students_id' => 'required',
        ];
    }
}
