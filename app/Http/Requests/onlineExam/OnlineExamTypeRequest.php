<?php

namespace App\Http\Requests\onlineExam;

use Illuminate\Foundation\Http\FormRequest;

class OnlineExamTypeRequest extends FormRequest
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

        // if ($this->onlineExamType) {
        //     return [
        //         'name' => 'required|string|max:255',
        //         'status' => 'required',
        //     ];
        // }
        // return [
        //     'name' => 'required|string|unique:online_exam_types|max:255',
        //     'status' => 'required',
        // ];


        return [
            'name' => 'required|string|max:255',
            'status' => 'required',
        ];
    }
}
