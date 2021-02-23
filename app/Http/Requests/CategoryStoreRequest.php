<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => ['required','unique:categories,name']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo es obligatorio.',
            'name.unique' => 'El campo debe ser unico.'
        ];
    }
}
