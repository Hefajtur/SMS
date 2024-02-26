<?php

namespace App\Http\Requests\routine;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoutineRequest extends FormRequest
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
                'class_id' => 'required',
                'section_id' => 'required',
                'shift_id' => 'required',
                'day' => 'required',
            ];
        }
    
        public function messages()
        {
            return [
                'class_id.required' => 'The class field is required!',
                'section_id.required' => 'The section field is required!',
                'shift_id.required' => 'The shift field is required!',
            ];
        }
    }

