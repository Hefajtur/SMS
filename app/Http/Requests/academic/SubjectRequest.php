<?php

namespace App\Http\Requests\academic;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
        // return [
        //     'name' => 'required|string|unique:subjects,name',
        //     'code' => 'required|string|unique:subjects,code',
        // ];

        if ($this->subject) {
            return [
                'name' => 'required|string|unique:subjects,name,' . $this->subject->id, '|max:255',
                'code' => 'required|string|unique:subjects,code,' . $this->subject->id, '|max:255',

            ];
        }
        return [
            'name' => 'required|string|unique:subjects|max:255',
            'code' => 'required|string|unique:subjects|max:255',

        ];
    }
}
