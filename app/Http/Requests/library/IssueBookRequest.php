<?php

namespace App\Http\Requests\library;

use Illuminate\Foundation\Http\FormRequest;

class IssueBookRequest extends FormRequest
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

        if ($this->issueBook) {
            return [
                'issue_book' => 'required|unique:issue_books, issue_book,' . $this->issueBook->id, '|max:255',
                'issue_book_member' => 'required',
                'issue_date' => 'required',
                'return_date' => 'required',
                'phone' => 'required',
                'description' => 'required',
                // 'description' => 'required',
                'status' => 'required',
            ];
        }
        return [
            'issue_book' => 'required',
            'issue_book_member' => 'required',
            'issue_date' => 'required',
            'return_date' => 'required',
            'phone' => 'required',
            'description' => 'required',
            // 'description' => 'required',
            // 'status' => 'required',
        ];
        

        // return [
        //     'issue_book' => 'required',
        //     'issue_book_member' => 'required',
        //     'issue_date' => 'required',
        //     'return_date' => 'required',
        //     'phone' => 'required',
        //     'description' => 'required',
        //     // 'description' => 'required',
        //     'status' => 'required',



        // ];


        // if ($this->religion) {

        //     var_dump($this->religion);
        //     die();
        //     return [
        //         'name' => 'required|string|unique:religions,name,' . $this->religion->id, '|max:255',
        //         'status' => 'required',
        //         'issue_book' => 'required',
        //         'issue_book_member' => 'required',
        //         'code' => 'required',
        //         'issue_date' => 'required',
        //         'return_date' => 'required',
        //         'phone' => 'required',
        //         'description' => 'required',
        //         'quantity' => 'required',
        //         'description' => 'required',
        //         'status' => 'required',



        //     ];
        // }
        // return [
        //     'name' => 'required|string|unique:religions|max:255',
        //     'status' => 'required',
        // ];

        
        // return [
        //     //
        // ];
    }
}
