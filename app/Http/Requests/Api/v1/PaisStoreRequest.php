<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaisStoreRequest extends FormRequest
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
            'cod_pais' =>  [
                'required',
                'string',
                'max:4', 
                Rule::unique('pais')
                       ->where('cod_pais', $this->cod_pais)
            ],
            'des_pais' =>'required|string|max:255',
            'status_pais' =>'required|integer',
        ];
    }
}
