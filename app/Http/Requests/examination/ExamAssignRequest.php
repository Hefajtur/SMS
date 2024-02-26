<?php

namespace App\Http\Requests\examination;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamAssignRequest extends FormRequest
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
        $subjectId = $this->route('examassigns');
        return [
            'exam_type' => 'required',
            'section_id' => 'required',
            'class_id' => 'required',
            'title' => 'required',
            'marks' => 'required',
            'subject_id' => 'required',
            // 'subject_id' => 'required|unique:exam_assign_data,class_id,section_id',
            // 'subject_id' =>  [ 'required',
            //     Rule::unique('exam_assign_data', 'subject_id')
            //         ->where(function ($query) {
            //             return $query->where('subject_id', $this->subject_id);
            //         })
            //         ->ignore($subjectId),
            // ],
          ];
    }
    public function messages()
    {
        return [
            'subject_id.unique' => 'The class field is already taken!'
        ];
    }
}
