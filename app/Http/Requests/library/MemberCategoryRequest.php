<?php

namespace App\Http\Requests\library;

use Illuminate\Foundation\Http\FormRequest;

class MemberCategoryRequest extends FormRequest
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
        if ($this->memberCategory) {
            return [
                'member_cat_name' => 'required|string|unique:member_categories,member_cat_name,' . $this->memberCategory->id, '|max:255',
                'status' => 'required',
            ];
        }
        return [
            'member_cat_name' => 'required|string|unique:member_categories|max:255',
            'status' => 'required',
        ];
    }
}
