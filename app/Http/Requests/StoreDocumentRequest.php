<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            'folio'=>['required','max:255'],
            'subject'=>['required','max:255'],
            'description'=>['required','max:1000'],
            'received_since'=>['required','date'],
            'document_date'=>['required','date'],
            'tags'=>['nullable','exists:App\Models\Tag,id'],
            'senders'=>['required','exists:App\Models\Sender,id'],
            'pdfs.*'=> ['required','file','mimetypes:application/pdf','max:2048']
        ];
    }
}
