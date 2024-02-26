<?php

namespace App\Http\Requests\examination;

use Illuminate\Foundation\Http\FormRequest;

class MarkRegisterRequest extends FormRequest
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
        return [
           'exam_type' => 'required|max:255',
            'class_id' => 'required|max:255',
            'section_id' => 'required|max:5',
            'subject_id' => 'required|max:255',
            // 'student_id' => 'required|max:255',
            
            'student_id' => 'required|unique:mark_registers,subject_id',
            'total' => 'required|max:255',
            'marks' => 'required|max:255',
        ];
       
    }
     public function messages()
    {
        
        return [
            'student_id.unique' => 'The class field is already taken!'
        ];
    }
}
