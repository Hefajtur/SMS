<?php

namespace App\Http\Requests\fees;

use Illuminate\Foundation\Http\FormRequest;

class FeesTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {

        if ($this->type) {
          return[
              'name' => 'required|string|unique:types,name,' . $this->type->id,
              'code' => 'required|string|max:32',
              'description' => 'required|min:11|max:255|',
          ];
        } 

        return [
            'name' => 'required|string|unique:types,id,|max:255',
            'code' => 'required|string|max:32',
            'description' => 'required|min:11|max:255|',
        ];
    }
}