<?php

namespace App\Http\Requests\academic;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoomRequest extends FormRequest
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
       

        if ($this->classRoom) {
            return [
                'room_no' => 'required|string|unique:class_rooms,room_no,' . $this->classRoom->id, '|max:255',
                'capacity' => 'required|max:3',
            ];
        }
        return [
            'room_no' => 'required|string|unique:class_rooms|max:255',
            'capacity' => 'required|max:3',
        ];
    }
}
