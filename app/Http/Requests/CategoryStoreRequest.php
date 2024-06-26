<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
        if ($this->studentCategory) {
            // Update
            return [
                'name' => 'required|string|unique:student_categories,name,' . $this->studentCategory->id . '|max:255|min:6',
            ];
        }
        // Create
        return [
            'name' => 'required|string|unique:student_categories|max:255|min:6',
        ];
    }
    
}
