<?php

namespace App\Http\Requests\gallery;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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

            //for update
            return [

                
            ];
        }

        // for create
        return [
           'gallary_category_id' =>'required',
            'image' => 'required','image','mimes:jpg,png,jpeg,gif,svg',
       
        ];
    }

    public function messages()
    {
        return [
            'gallary_category_id.required' => 'Gallery category is required.',
        ];
    }
}
