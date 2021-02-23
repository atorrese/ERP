<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'names'=>'required',
            'surnames'=>'required',
            'identification_card'=>'required|unique:clients,identification_card,'.$this->client->id,
            'birthdate'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required|unique:clients,email,'.$this->client->id
        ];
    }
    public function messages()
    {
        return [
            'names.required' => 'El campo es obligatorio.',
            'surnames.required' => 'El campo es obligatorio.',
            'identification_card.required' => 'El campo es obligatorio.',
            'identification_card.unique' => 'El campo debe ser unico.',
            'birthdate.required' => 'El campo es obligatorio.',
            'address.required' => 'El campo es obligatorio.',
            'email.required' => 'El campo es obligatorio.',
            'email.unique' => 'El campo debe ser unico.',
            'phone.required'=> 'El campo es obligatorio.'
        ];
    }
}
