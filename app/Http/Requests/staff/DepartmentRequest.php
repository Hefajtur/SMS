<?php

namespace App\Http\Requests\staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
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
        // dd($this->department);
        // if ($this->department) {
        //     return [
        //         'department' => 'required|string|unique:departments,department,' . $this->department->id, '|max:255',
        //         'status' => 'required',
        //     ];
        // }
        return [
            'department' => 'required|string|max:255',
            'status' => 'required',
        ];

        // return [];
    }
}
