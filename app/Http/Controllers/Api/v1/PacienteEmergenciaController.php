<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\PacienteEmergenciaStoreRequest;
use App\Http\Requests\Api\v1\PacienteEmergenciaUpdateRequest;
use App\Models\Api\PacienteEmergencia;
use App\Models\Api\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PacienteEmergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacienteEmergenciaStoreRequest $request)
    {
        $pacienteEmergencia = PacienteEmergencia::create($request->all());
        
        return response()->json([
            'status' => 'ok',
            'message' => 'Paciente creado exitosamente!',
            'data'=> $pacienteEmergencia]
        ,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pacienteEmergencia = PacienteEmergencia::find($id);
        
        if ( empty($pacienteEmergencia) ) {
            return response()->json([
                'message' => 'Detalle del Paciente',
                'status'=>'not found'],
            404);
        } 
        $persona = Persona::find($pacienteEmergencia->persona_id);
        $pacienteEmergencia[
            'readonly_apellidosNombresDoctor_paciente'
            ] = empty($persona) ? '' : $persona->apellidos.' '. $persona->nombres;
        $pacienteEmergencia[
                'readonly_identificacion_paciente'
                ] = empty($persona) ? '' : $persona->identificacion;
        $pacienteEmergencia[
                    'readonly_tipo_persona_paciente'
                    ] = empty($persona) ? '' : $persona->tipo_persona_id;

        return response()->json([
            'message' => 'Detalle del paciente',
            'status'=>'ok',
            'data' => $pacienteEmergencia],
        200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteEmergenciaUpdateRequest $request, $id)
    {
        $pacienteEmergencia = PacienteEmergencia::find($id);

        if (empty($pacienteEmergencia)) {
            return response()->json([
                    'message' => 'Actualizacion del Paciente',
                    'status' => 'Not found',
            ], 404);
        }

        $pacienteEmergencia->fill($request->all());
        $pacienteEmergencia->save();

        return response()->json([
            'message' => 'Actualizacion del Paciente',
            'status'=>'ok',
            'data' => $pacienteEmergencia
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
