<?php

namespace App\Http\Requests\setting;

use Illuminate\Foundation\Http\FormRequest;

class GenderRequest extends FormRequest
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
        // dd($this->gender);
        if ($this->gender) {
            return [
                'name' => 'required|string|unique:genders,name,' . $this->gender->id, '|max:255',
                'status' => 'required',
            ];
        }
        return [
            'name' => 'required|string|unique:genders|max:255',
            'status' => 'required',
        ];
    }
}
