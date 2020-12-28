<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PacienteUpdateRequest extends FormRequest
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
            'tipo_id' =>'required|string|max:2',
            'identificacion' =>  [
                'required',
                'string',
                'max:10', 
                Rule::unique('paciente')
                       ->ignore($this->id)
                       ->where('tipo_id', $this->tipo_id)
            ],
            'nombres' =>'required|string|max:255',
            'apellidos' =>'required|string|max:255',
            'email' =>'required|string|email|max:255',
            'sexo' =>'required|string|max:2',
            'fecha_nac' =>'required|date',
        ];
    }
}
