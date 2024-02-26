<?php

namespace App\Http\Requests\academic;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SectionRequest extends FormRequest
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
    public function rules()
{
    $sectionId = $this->route('section'); // Get the section ID for update, if applicable

    return [
        'class_id' => 'required|exists:classes,id',
        'name' => [
            'required',
            'string',
            Rule::unique('sections', 'name')
                ->where(function ($query) {
                    return $query->where('class_id', $this->class_id);
                })
                ->ignore($sectionId),
        ],
    ];
}

    public function messages()
    {
        return [
            'class_id.required' => 'The class field is required!',
        ];
    }

}
