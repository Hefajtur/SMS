<?php

namespace App\Http\Requests\examination;

use Illuminate\Foundation\Http\FormRequest;

class ExamTypeRequest extends FormRequest
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
        // dd($this->examtype);
        if ($this->examtype) {
            return[
                'name' => 'required|string|unique:exam_types,name,' . $this->examtype->id,
                'status' => 'required'
            ];
          } 
            return [
              'name' => 'required|string|unique:exam_types',
              'status' => 'required'
            ];
    }
}
