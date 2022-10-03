<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'text'=>['required','max:1000'],
            'pdf'=> ['nullable','file','mimetypes:application/pdf','max:2048'],
            'turn_id'=>['required','exists:App\Models\Turn,id'],
            'parent_id'=>['nullable','exists:App\Models\Comment,id']
        ];
    }
}
