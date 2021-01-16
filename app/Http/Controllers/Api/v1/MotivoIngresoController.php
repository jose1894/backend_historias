<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\MotivoIngresoStoreRequest;
use App\Http\Requests\Api\v1\MotivoIngresoUpdateRequest;
use App\Models\Api\MotivoIngreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MotivoIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motivoIngresos = Cache::remember('cachemotivoIngresos',15/60, function() {
			return MotivoIngreso::simplePaginate(20);  // Paginamos cada 20 elementos.
        });
        
		return response()->json([
            'message' => 'Motivo Ingreso list',
            'status'=>'ok',
            'totalRecords' => sizeOf($motivoIngresos->items()),
            'siguiente'=>$motivoIngresos->nextPageUrl(),
            'anterior'=>$motivoIngresos->previousPageUrl(),
            'data'=>$motivoIngresos->items(),
        ], 200);
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MotivoIngresoStoreRequest $request)
    {
        $motivoIngreso = MotivoIngreso::create($request->all());
        
        return response()->json([
            'status' => 'ok',
            'message' => 'Motivo Ingreso creado exitosamente!',
            'data'=> $motivoIngreso]
        ,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Api\MotivoIngreso  $motivoIngreso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $motivoIngreso = MotivoIngreso::find($id);
        
        if ( empty($motivoIngreso) ) {
            return response()->json([
                'message' => 'Detalle del Motivo Ingreso',
                'status'=>'not found'],
            404);
        } 

        return response()->json([
            'message' => 'Detalle del Motivo Ingreso',
            'status'=>'ok',
            'data' => $motivoIngreso],
        200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Api\MotivoIngreso  $motivoIngreso
     * @return \Illuminate\Http\Response
     */
    public function update(MotivoIngresoUpdateRequest $request, $id)
    {
        $motivoIngreso = MotivoIngreso::find($id);

        if (empty($motivoIngreso)) {
            return response()->json([
                    'message' => 'Actualizacion del Motivo Ingreso',
                    'status' => 'Not found',
            ], 404);
        }

        $motivoIngreso->fill($request->all());
        $motivoIngreso->save();

        return response()->json([
            'message' => 'Actualizacion del Motivo Ingreso',
            'status'=>'ok',
            'data' => $motivoIngreso
        ],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Api\MotivoIngreso  $motivoIngreso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $motivoIngreso = MotivoIngreso::find($id);
        
        if ( empty($motivoIngreso) ) {
            return response()->json([
                'message' => 'Detalle del Motivo Ingreso',
                'status'=>'not found'
            ],404);
        } 

        $emergencias = count($motivoIngreso->emergencias());

        if ( $emergencias > 0) {
            return response()->json([
                'message' => 'Motivo Ingreso  no puede ser eliminado porque esta relacionado con emergencias',
            ], 402);    
        }
        
        $motivoIngreso->delete();
        
		// Se devuelve código 204 No Content.
		return response()->json([
            'message' => 'Motivo Ingreso eliminado',
        ], 200);
    }
}
