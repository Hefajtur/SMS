<?php

namespace App\Http\Requests\academic;

use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
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
        if ($this->shift) {
            // Update
            return [
                'name' => 'required|string|unique:shifts,name,' . $this->shift->id . '|max:255',
            ];
        }
        // Create
        return [
            'name' => 'required|string|unique:shifts|max:255',
        ];
    }
}
