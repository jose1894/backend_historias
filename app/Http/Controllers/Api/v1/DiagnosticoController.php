<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\DiagnosticoStoreRequest;
use App\Http\Requests\Api\v1\DiagnosticoUpdateRequest;
use App\Models\Api\Diagnostico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnosticos = Cache::remember('cachediagnosticos',15/60, function() {
			return Diagnostico::simplePaginate(20);  // Paginamos cada 20 elementos.
        });
        
		return response()->json([
            'message' => 'Diagnostico list',
            'status'=>'ok',
            'totalRecords' => sizeOf($diagnosticos->items()),
            'siguiente'=>$diagnosticos->nextPageUrl(),
            'anterior'=>$diagnosticos->previousPageUrl(),
            'data'=>$diagnosticos->items(),
        ], 200);
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiagnosticoStoreRequest $request)
    {
        $diagnostico = Diagnostico::create($request->all());
        
        return response()->json([
            'status' => 'ok',
            'message' => 'Diagnostico creado exitosamente!',
            'data'=> $diagnostico]
        ,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Api\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diagnostico = Diagnostico::find($id);
        
        if ( empty($diagnostico) ) {
            return response()->json([
                'message' => 'Detalle del Diagnostico',
                'status'=>'not found'],
            404);
        } 

        return response()->json([
            'message' => 'Detalle del Diagnostico',
            'status'=>'ok',
            'data' => $diagnostico],
        200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Api\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function update(DiagnosticoUpdateRequest $request, $id)
    {
        $diagnostico = Diagnostico::find($id);

        if (empty($diagnostico)) {
            return response()->json([
                    'message' => 'Actualizacion del Diagnostico',
                    'status' => 'Not found',
            ], 404);
        }

        $diagnostico->fill($request->all());
        $diagnostico->save();

        return response()->json([
            'message' => 'Actualizacion del Diagnostico',
            'status'=>'ok',
            'data' => $diagnostico
        ],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Api\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $diagnostico = Diagnostico::find($id);
        
        if ( empty($diagnostico) ) {
            return response()->json([
                'message' => 'Detalle del Diagnostico',
                'status'=>'not found'
            ],404);
        } 
        
        $emergencias = count($diagnostico->emergencias());

        if ( $emergencias > 0) {
            return response()->json([
                'message' => 'Diagnostico no puede ser eliminado porque esta relacionado con emergencias',
            ], 402);    
        }
        
        $diagnostico->delete();
        
		// Se devuelve código 204 No Content.
		return response()->json([
            'message' => 'Diagnostico eliminado',
        ], 200);
    }
}
