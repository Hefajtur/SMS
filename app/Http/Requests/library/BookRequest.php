<?php

namespace App\Http\Requests\library;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        if ($this->book) {
            return [
                'name' => 'required|string|unique:books,name,' . $this->book->id, '|max:255',
                'book_category_id' => 'required',
                'code' => 'required',
                'publisher_name' => 'required',
                'author_name' => 'required',
                'rack_no' => 'required',
                'price' => 'required',
                'quantity' => 'required',
                'status' => 'required',
            ];
        }
        
        return [
            'name' => 'required|string|unique:books|max:255',
            'book_category_id' => 'required',
            'code' => 'required',
            'publisher_name' => 'required',
            'author_name' => 'required',
            'rack_no' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'status' => 'required',
        ];
    }
}
