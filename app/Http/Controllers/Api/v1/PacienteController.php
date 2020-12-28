<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\PacienteStoreRequest;
use App\Http\Requests\Api\v1\PacienteUpdateRequest;
use App\Models\Api\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Cache::remember('cachepacientes',15/60, function() {
			return Paciente::simplePaginate(20);  // Paginamos cada 20 elementos.
        });
        
		return response()->json([
            'message' => 'Pacientes list',
            'status'=>'ok',
            'totalRecords' => sizeOf($pacientes->items()),
            'siguiente'=>$pacientes->nextPageUrl(),
            'anterior'=>$pacientes->previousPageUrl(),
            'data'=>$pacientes->items(),
        ], 200);
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacienteStoreRequest $request)
    {
        $paciente = Paciente::create($request->all());
        
        return response()->json([
            'status' => 'ok',
            'message' => 'Paciente creado exitosamente!',
            'data'=> $paciente]
        ,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Api\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::find($id);
        
        if ( empty($paciente) ) {
            return response()->json([
                'message' => 'Detalle del Paciente',
                'status'=>'not found'],
            404);
        } 

        return response()->json([
            'message' => 'Detalle de la Marca',
            'status'=>'ok',
            'data' => $paciente],
        200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Api\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteUpdateRequest $request, $id)
    {
        $paciente = Paciente::find($id);

        if (empty($paciente)) {
            return response()->json([
                    'message' => 'Actualizacion del Paciente',
                    'status' => 'Not found',
            ], 404);
        }

        $paciente->fill($request->all());
        $paciente->save();

        return response()->json([
            'message' => 'Actualizacion del Paciente',
            'status'=>'ok',
            'data' => $paciente
        ],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Api\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $paciente = Paciente::find($id);
        
        if ( empty($paciente) ) {
            return response()->json([
                'message' => 'Detalle del Paciente',
                'status'=>'not found'
            ],404);
        } 
        
        $paciente->delete();
        
		// Se devuelve código 204 No Content.
		return response()->json([], 204);
    }
}
