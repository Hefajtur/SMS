<?php

namespace App\Http\Requests\library;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
        if ($this->member) {
            // var_dump($this->member);
            // die();
            return [
                'user_id' => 'required|unique:members, user_id,' . $this->member->id, '|max:255',
                'member_cat' => 'required',
                'status' => 'required',
            ];
        }
        return [
            'user_id' => 'required|unique:members|max:255',
            'member_cat' => 'required',
            'status' => 'required',
        ];

        // return [

        // ];
    }
}
