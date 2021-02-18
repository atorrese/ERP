<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => ['required','unique:products,name'],
            'description'=>'required',
            'price'=>'required',
            'cost'=>'required',
            'stock'=>'required',
            'category_id'=>''
        ];
    }
    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
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
