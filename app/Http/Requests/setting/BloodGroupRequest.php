<?php

namespace App\Http\Requests\setting;

use Illuminate\Foundation\Http\FormRequest;

class BloodGroupRequest extends FormRequest
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
        // if ($this->bloodGroup) {
        //     return [
        //         'name' => 'required|string|unique:blood_groups,name,' . $this->bloodGroup->id, '|max:255',
        //         'status' => 'required',
        //     ];
        // }
        return [
            'name' => 'required|string|max:255',
            'status' => 'required',
        ];
    }
}
