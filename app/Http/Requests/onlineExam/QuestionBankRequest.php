<?php

namespace App\Http\Requests\onlineExam;

use Illuminate\Foundation\Http\FormRequest;

class QuestionBankRequest extends FormRequest
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
        if (isset($_REQUEST['question_type']) && $_REQUEST['question_type'] == 1) {
            return [
                'question_type' => 'required',
                'question_group' => 'required',
                'status' => 'required',
                'mark' => 'required',
                'question' => 'required',
                'sc_total_option' => 'required',
                'sc_singleOption' => 'required',
                'sc_answer' => 'required',
            ];

        }else{
            return [
                'question_type' => 'required',
                'question_group' => 'required',
                'status' => 'required',
                'mark' => 'required',
                'question' => 'required',
                // 'sc_total_option' => 'required',
                // 'sc_singleOption' => 'required',
            ]; 
        }
        
        
        
        if (isset($_REQUEST['question_type']) && $_REQUEST['question_type'] == 2) {
            return [
                'question_type' => 'required',
                'question_group' => 'required',
                'status' => 'required',
                'mark' => 'required',
                'question' => 'required',
                'mcq_total_option' => 'required',
                'mcq_SingleOption' => 'required',
                'mcq_answer' => 'required',
            ];
        }
        
        
        
        if (isset($_REQUEST['question_type']) && $_REQUEST['question_type'] == 3) {
            return [
                'question_type' => 'required',
                'question_group' => 'required',
                'status' => 'required',
                'mark' => 'required',
                'question' => 'required',
                'trueFalseAnswer' => 'required',
            ];
        }
    }
}
