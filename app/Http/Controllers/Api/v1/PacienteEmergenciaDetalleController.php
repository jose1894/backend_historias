<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\PacienteEmergenciaDetalleStoreRequest;
use App\Http\Requests\Api\v1\PacienteEmergenciaDetalleUpdateRequest;
use App\Models\Api\PacienteEmergenciaDetalle;
use App\Models\Api\PacienteEmergencia;
use App\Models\Api\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PacienteEmergenciaDetalleController extends Controller
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
    public function store(PacienteEmergenciaDetalleStoreRequest $request)
    {
        
        $pacienteEmergenciaDetalle = PacienteEmergenciaDetalle::create($request->all());

        return response()->json(
            [
                'status' => 'ok',
                'message' => 'Paciente creado exitosamente!',
                'data' => $pacienteEmergenciaDetalle
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pacienteEmergenciaDetalle = PacienteEmergenciaDetalle::find($id);

        if (empty($pacienteEmergenciaDetalle)) {
            return response()->json(
                [
                    'message' => 'Detalle del Paciente',
                    'status' => 'not found'
                ],
                404
            );
        }
        $persona = Persona::find($pacienteEmergenciaDetalle->persona_id);
        $paciente_emergencia = PacienteEmergencia::find($pacienteEmergenciaDetalle->paciente_emergencia_id);
        $pacienteEmergenciaDetalle['readonly_apellidosNombresDoctor_paciente'] = empty($persona) ? '' : $persona->apellidos . ' ' . $persona->nombres;
        $pacienteEmergenciaDetalle['readonly_identificacion_paciente'] = empty($persona) ? '' : $persona->identificacion;
        $pacienteEmergenciaDetalle['readonly_tipo_persona_paciente'] = empty($persona) ? '' : $persona->tipo_persona_id;

        $personaPacienteEmergencia = Persona::find($paciente_emergencia->persona_id);
        $paciente_emergencia['readonly_apellidosNombresDoctor_paciente'] = empty($personaPacienteEmergencia) ? '' : $personaPacienteEmergencia->apellidos . ' ' . $personaPacienteEmergencia->nombres;
        $paciente_emergencia['readonly_identificacion_paciente'] = empty($personaPacienteEmergencia) ? '' : $personaPacienteEmergencia->identificacion;
        $paciente_emergencia['readonly_tipo_persona_paciente'] = empty($personaPacienteEmergencia) ? '' : $personaPacienteEmergencia->tipo_persona_id;
        $pacienteEmergenciaDetalle['paciente_emergencia'] = $paciente_emergencia;

        return response()->json(
            [
                'message' => 'Detalle del paciente',
                'status' => 'ok',
                'data' => $pacienteEmergenciaDetalle
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteEmergenciaDetalleUpdateRequest $request, $id)
    {
        $pacienteEmergenciaDetalle = PacienteEmergenciaDetalle::find($id);

        if (empty($pacienteEmergenciaDetalle)) {
            return response()->json([
                'message' => 'Actualizacion del Paciente',
                'status' => 'Not found',
            ], 404);
        }

        $pacienteEmergenciaDetalle->fill($request->all());
        $pacienteEmergenciaDetalle->save();

        return response()->json([
            'message' => 'Actualizacion del Paciente',
            'status' => 'ok',
            'data' => $pacienteEmergenciaDetalle
        ], 200);
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
