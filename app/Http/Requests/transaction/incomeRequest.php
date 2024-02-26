<?php

namespace App\Http\Requests\transaction;

use Illuminate\Foundation\Http\FormRequest;

class incomeRequest extends FormRequest
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
                'invoice_num' => 'required|unique:incomes,invoice_num,' . $a,
                'name' => 'required|max:255',
                'date' => 'required',
                'amount' => 'required|max:11|',
                'description' => 'required',


            ];
        }

        // for create
        return [
            'invoice_num' => 'required|unique:incomes,invoice_num|max:11',
            'name' => 'required|max:255',
            'date' => 'required',
            'amount' => 'required|max:11|',
            'document' => 'required','document','mimes:jpg,png,jpeg,gif,svg',
            'description' => 'required',
        
        ];
    }


    public function messages()
    {
        return [
        
            'section_id.required' => 'Section name is required.',
        ];
    }
}
