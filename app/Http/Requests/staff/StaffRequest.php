<?php

namespace App\Http\Requests\staff;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
        // dd($_REQUEST);
        return [
            // 'staffID' => 'required',
            // 'role_id' => 'required',
            // 'designation_id' => 'required',
            // 'department_id' => 'required',
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'father_name' => 'required',
            // 'mother_name' => 'required',
            // 'email' => 'required|unique:UserStaffs',
            // 'gender' => 'required',
            // 'dob' => 'required',
            // 'join_date' => 'required',
            // 'phone' => 'required|unique:UserStaffs',
            // 'emergency_contact' => 'required',
            // 'marital_status' => 'required',
            // 'status' => 'required',
            // 'image' => 'required',
            // 'current_add' => 'required',
            // 'permanent_add' => 'required',
            // 'status' => 'required',
            // 'basic_salary' => 'required',
            // 'add_doc_name' => 'required',
            // 'add_doc_img' => 'required',
            
        ];
    }
}
