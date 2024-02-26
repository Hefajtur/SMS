<?php

namespace App\Http\Requests\staff;

use Illuminate\Foundation\Http\FormRequest;

class DesignationRequest extends FormRequest
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
        // dd($this->designation);
        if ($this->designation) {
            return [
                // 'designation' => 'required|string|unique:designations,name,' . $this->designation->id, '|max:255',
                'status' => 'required',
            ];
        }
        return [
            'designation' => 'required|string|unique:designations|max:255',
            'status' => 'required',
        ];
    }


}
