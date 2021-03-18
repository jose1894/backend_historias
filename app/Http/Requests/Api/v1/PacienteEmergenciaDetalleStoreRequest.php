<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class PacienteEmergenciaDetalleStoreRequest extends FormRequest
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
            'paciente_id' => 'required',
            'motivoingreso' => 'required',
            'dignostico' => 'required',
            'dest',
            'observaciones'
        ];
    }
}
