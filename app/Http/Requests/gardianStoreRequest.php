<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class gardianStoreRequest extends FormRequest
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

        if ($_REQUEST['id'] != null) {
            $a = $_REQUEST['id'];


        return [
            'fath_name' => 'required|string|max:50',
            'fath_mobile' => 'required|max:50',
            'fath_prof' => 'required|string|max:50',
            'mother_name' => 'required|string|max:50',
            'mother_mobile' => 'required|max:50',
            'mother_prof' => 'required|string|max:50',
            'guard_name' => 'required|string|max:50',
            'guard_mobile' => 'required',
            'guard_prof' => 'required|string|max:50',
            'guard_email' => 'required|string|max:50',
            'guard_address' => 'required|string',
            'guard_rel' => 'required|string|max:50',
        ];
    }

    return [
        'fath_name' => 'required|string|max:50',
        'fath_mobile' => 'required|max:11',
        'fath_prof' => 'required|string|max:50',
        'fath_img' => 'required',
        'mother_name' => 'required|string|max:50',
        'mother_mobile' => 'required|max:11',
        'mother_prof' => 'required|string|max:50',
        'mother_img' => 'required',
        'guard_name' => 'required|string|max:50',
        'guard_mobile' => 'required|min:6',
        'guard_prof' => 'required|string|max:50',
        'guard_img' => 'required',
        'guard_email' => 'required|string|max:50',
        'guard_address' => 'required|string',
        'guard_rel' => 'required|string|max:50',
    ];

    }

    public function messages()
    {
        return [
            'fath_name.required' => 'This field is required',
            'fath_mobile.required' => 'This field is required',
            'fath_prof.required' => 'This field is required',
            'fath_img.required' => 'This field is required',
            'mother_name.required' => 'This field is required',
            'mother_mobile.required' => 'This field is required',
            'mother_prof.required' => 'This field is required',
            'mother_img.required' => 'This field is required',
            'guard_name.required' => 'This field is required',
            'guard_mobile.required' => 'This field is required',
            'guard_prof.required' => 'This field is required',
            'guard_img.required' => 'This field is required',
            'guard_email.required' => 'This field is required',
            'guard_address.required' => 'This field is required',
            'guard_rel.required' => 'This field is required',
        ];
    }
}
