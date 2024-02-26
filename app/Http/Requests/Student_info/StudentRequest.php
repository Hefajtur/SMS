<?php

namespace App\Http\Requests\Student_info;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        // dd($_REQUEST['id']);

        if ($_REQUEST['id'] != null) {
            $a = $_REQUEST['id'];

            //for update
            return [
                'admission_no' => 'required|max:11',
                'roll_no' => 'required|max:11',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'mobile' => 'required|max:11|',
                'email' => 'required|email|unique:students,email,' . $a,
                'class_id' => 'required',
                'section_id' => 'required',
                'shift_id' => 'required',
                'b_date' => 'required',
                'religion' => 'required',
                'parent' => 'required',
                'gender' => 'required',
                'category_id' => 'required',
                'blood' => 'required',
                'admission_date' => 'required',
                'status' => 'required',
                'session_id' => 'required',
          
            ];
        }

        // for create
        return [
            'admission_no' => 'required|max:11',
            'roll_no' => 'required|max:11',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mobile' => 'required|max:11|',
            'email' => 'required|email|unique:students,email',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg',
            'class_id' => 'required',
            'section_id' => 'required',
            'shift_id' => 'required',
            'b_date' => 'required',
            'religion' => 'required',
            'parent' => 'required',
            'gender' => 'required',
            'category_id' => 'required',
            'blood' => 'required',
            'admission_date' => 'required',
            'status' => 'required',
            'session_id' => 'required',
           
        ];

    }
    

    public function messages()
    {
        return [
            'class_id.required' => 'Class name is required.',
            'section_id.required' => 'Section name is required.',
            'b_date.required' => 'Birth date is required.',
            'category_id.required' => 'category field is required.',
            'session_id.required' => 'Session field is required.',
            'shift_id.required' => 'Shift field is required.',
        ];
    }
}
