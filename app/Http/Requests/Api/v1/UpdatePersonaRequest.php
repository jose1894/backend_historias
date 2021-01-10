<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonaRequest extends FormRequest
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
            'identificacion' =>  'required|string|max:10|unique:persona,identificacion,'.$this->persona,
            'nombres' =>'required|string|max:255',
            'apellidos' =>'required|string|max:255',
            'email' =>'required|string|email|max:255',
            'sexo' =>'required|string|max:2',
            'fecha_nac' =>'required|date',
            'direccion' => 'required|string|max:500',
            'especialidad_id' => 'required',
            'area_id' => 'required',
            'tipo_persona_id' => 'required',
        ];
    }
}
