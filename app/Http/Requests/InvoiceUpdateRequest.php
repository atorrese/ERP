<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'client_id' => 'required',
            'user_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'client_id.required' => 'El campo es obligatorio.',
            'user_id.required' => 'El campo es obligatorio.'
        ];
    }

    public function authorize()
    {
        return true;
    }
}