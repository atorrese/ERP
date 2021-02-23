<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
            'name'=>['required', Rule::unique('products')->ignore($this->product->id)],
            'description'=>'required',
            'price'=>'required',
            'cost'=>'required',
            'stock'=>'required',
            'category_id'=>''
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'El campo es obligatorio.',
            'name.unique' => 'El campo debe ser unico.',
            'description.required' => 'El campo es obligatorio.',
            'price.required' => 'El campo es obligatorio.',
            'cost.required' => 'El campo es obligatorio.',
            'stock.required' => 'El campo es obligatorio.'
        ];
    }
}
