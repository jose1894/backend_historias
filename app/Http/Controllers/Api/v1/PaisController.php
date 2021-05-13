<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\PaisStoreRequest;
use App\Http\Requests\Api\v1\PaisUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Api\Pais;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Cache::remember('cachepaises',15/60, function() {
			return Pais::simplePaginate(20);  // Paginamos cada 20 elementos.
        });
        
		return response()->json([
            'message' => 'Paises list',
            'status'=>'ok',
            'totalRecords' => sizeOf($paises->items()),
            'siguiente'=>$paises->nextPageUrl(),
            'anterior'=>$paises->previousPageUrl(),
            'data'=>$paises->items(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaisStoreRequest $request)
    {
        $pais = Pais::create($request->all());
        
        return response()->json([
            'status' => 'ok',
            'message' => 'Pais creado exitosamente!',
            'data'=> $pais]
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
        $pais = Pais::find($id);
        
        if ( empty($pais) ) {
            return response()->json([
                'message' => 'Detalle del Pais',
                'status'=>'not found'],
            404);
        } 

        return response()->json([
            'message' => 'Detalle del Pais',
            'status'=>'ok',
            'data' => $pais],
        200);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Api\Pais  $$pais
    * @return \Illuminate\Http\Response
    */
    public function update(PaisUpdateRequest $request, $id)
    {
        $pais = Pais::find($id);

        if (empty($pais)) {
            return response()->json([
                    'message' => 'Actualizacion del Pais',
                    'status' => 'Not found',
            ], 404);
        }

        $pais->fill($request->all());
        $pais->save();

        return response()->json([
            'message' => 'Actualizacion del Pais',
            'status'=>'ok',
            'data' => $pais
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
        $pais = Pais::find($id);
        
        if ( empty($pais) ) {
            return response()->json([
                'message' => 'Detalle del Pais',
                'status'=>'not found'
            ],404);
        } 
        
        $pais->delete();
        
		// Se devuelve código 204 No Content.
		return response()->json([
            'message' => 'Pais eliminado',
        ], 200);
    }
}
