<?php

namespace App\Http\Requests\fees;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
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
        if($this->group){
            return [
                'name' => 'required|string|unique:groups,name,' . $this->group->id,'|max:255',
                'description' => 'required|max:255|',
            ];
        }
        return [
            'name' => 'required|string|unique:groups|max:255',
            'description' => 'required|max:255|',
        ];
    }
}
