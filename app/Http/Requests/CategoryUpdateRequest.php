<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>[
                'required', Rule::unique('categories')->ignore($this->category->id)
            ]
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
