<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTurnRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'expiration'=>['required','date','after_or_equal_:today'],
            'additional_instructions'=>['nullable','max:1000'],
            'instruction_id'=>['required'],
            'profiles.*'=>['required','exists:App\Models\Profile,id']
        ];
    }
}
