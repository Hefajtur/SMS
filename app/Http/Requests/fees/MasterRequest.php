<?php

namespace App\Http\Requests\fees;

use Illuminate\Foundation\Http\FormRequest;

class MasterRequest extends FormRequest
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
       return[
            'group_id' => 'required|string|max:255',
            'type_id' => 'required|string|max:32',
            'due_date' => 'required',
            'amount' => 'required|min:3|max:8|',
            'fine_type' => 'required|min:3|max:25',
            'fine_amount' => 'required|min:2|max:255',
       ];

        // if ($this->master) {
        //     return[
        //         'name' => 'required|string|unique:types,name,' . $this->master->id,
        //         'code' => 'required|string|max:32',
        //         'description' => 'required|min:11|max:255|',
        //     ];
        //   } 
  
        //   return [
        //       'name' => 'required|string|unique:types,id,|max:255',
        //       'code' => 'required|string|max:32',
        //       'description' => 'required|min:11|max:255|',
        //   ];
    }
}
