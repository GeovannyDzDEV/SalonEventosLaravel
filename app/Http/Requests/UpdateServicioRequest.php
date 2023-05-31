<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServicioRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' =>  ['required', 'min:5', 'max:40', 'regex:/^[a-zA-ZÀ-ÿ\s]+$/u'],
            'descripcion' =>  ['required', 'min:10', 'max:20'],
            'costo' => 'required|regex:/^[0-9]+(?:\.[0-9]+)?$/',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El campo nombre es requerido',
            'nombre.min' => 'El campo nombre debe tener un minimo de :min caracteres',
            'nombre.max' => 'El campo nombre solo puede tener un maximo de :max caracteres',
            'nombre.regex' => 'El campo nombre solo puede contener letras.',

            'descripcion.required' => 'El campo descripcion es requerido',
            'descripcion.min' => 'El campo descripcion debe tener un minimo de :min caracteres',
            'descripcion.max' => 'El campo descripcion solo puede tener un maximo de :max caracteres',
            
		    'costo.required' => 'El campo costo es requerido',
            'costo.regex' => 'El campo número debe ser un número válido'
            

        ];
    }
}


