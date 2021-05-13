<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Api\Area;
use App\Models\Api\Persona;
use Illuminate\Http\Request;
use App\Models\Api\Especialidad;
use App\Models\Api\TipoPersona;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Api\v1\StorePersonaRequest;
use App\Http\Requests\Api\v1\UpdatePersonaRequest;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Cache::remember('cachepersonas',15/60, function() {
			return Persona::simplePaginate(20);  // Paginamos cada 20 elementos.
        });
        
		return response()->json([
            'message' => 'Personas list',
            'status'=>'ok',
            'totalRecords' => sizeOf($personas->items()),
            'siguiente'=>$personas->nextPageUrl(),
            'anterior'=>$personas->previousPageUrl(),
            'data'=>$personas->items(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonaRequest $request)
    {
        $persona = Persona::create($request->all());
        
        return response()->json([
            'status' => 'ok',
            'message' => 'Persona creado exitosamente!',
            'data'=> $persona]
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
        $persona = Persona::find($id);         
        if ( empty($persona) ) {
            return response()->json([
                'message' => 'Detalle del Persona',
                'status'=>'not found'],
            404);
        }
        
        $especialidad = Especialidad::find($persona->especialidad_id);
        $persona['readonly_especialidadDescription'] = empty($especialidad) 
                                                    ? '' : $especialidad->descripcion;
        $area = Area::find($persona->area_id);
        $persona['readonly_areaDescription'] = empty($area) 
                                             ? '' : $area->descripcion;
        $tipoPersona = TipoPersona::find($persona->tipo_persona_id);
        $persona['readonly_tipoPersonaDescription'] = empty($tipoPersona) 
                                            ? '' : $tipoPersona->descripcion;
        return response()->json([
            'message' => 'Detalle de la persona',
            'status'=>'ok',
            'data' => $persona,
        ],
        200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonaRequest $request, $id)
    {
        $persona = Persona::find($id);

        if (empty($persona)) {
            return response()->json([
                    'message' => 'Actualizacion de la persona',
                    'status' => 'Not found',
            ], 404);
        }

        $persona->fill($request->all());
        $persona->save();

        return response()->json([
            'message' => 'Actualizacion de la persona',
            'status'=>'ok',
            'data' => $persona
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
        $persona = Persona::find($id);
        
        if ( empty($persona) ) {
            return response()->json([
                'message' => 'Detalle de la persona',
                'status'=>'not found'
            ],404);
        } 
        
        $persona->delete();
        
		// Se devuelve código 204 No Content.
		return response()->json([
            'message' => 'Persona eliminada',
        ], 200);
    }
}
