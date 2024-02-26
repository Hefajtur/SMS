<?php

namespace App\Http\Requests\library;

use Illuminate\Foundation\Http\FormRequest;

class BookCategoryRequest extends FormRequest
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
        if ($this->bookCategory) {
            return [
                'book_cat_name' => 'required|string|unique:book_categories,book_cat_name,' . $this->bookCategory->id, '|max:255',
                'status' => 'required',
            ];
        }
        return [
            'book_cat_name' => 'required|string|unique:book_categories|max:255',
            'status' => 'required',
        ];
    }
}
