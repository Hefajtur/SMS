<?php

namespace App\Http\Requests\onlineExam;

use Illuminate\Foundation\Http\FormRequest;

class OnlineExamRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'start' => 'required',
            'end' => 'required',
            'published' => 'required',
            'qstGroup' => 'required',
            'classes' => 'required',
            'section' => 'required',
            'subject' => 'required',
            'total_mark' => 'required',
        ];
    }
}
