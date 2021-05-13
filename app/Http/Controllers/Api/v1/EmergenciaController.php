<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\EmergenciaDetalleStoreRequest;
use App\Http\Requests\Api\v1\EmergenciaDetalleUpdateRequest;
use App\Http\Requests\Api\v1\EmergenciaStoreRequest;
use App\Http\Requests\Api\v1\EmergenciaUpdateRequest;
use App\Models\Api\Emergencia;
use App\Models\Api\EmergenciaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emergencia = Emergencia::where('persona_id', 2)
            ->with([
            'detalle',
            'detalle.paciente', 
            'medico',
            'enfermero'])
            ->simplePaginate(50);

        return $emergencia;
        
		/*return response()->json([
            'message' => 'Emergencia list',
            'status'=>'ok',
            'totalRecords' => sizeOf($emergencia->items()),
            'siguiente'=>$emergencia->nextPageUrl(),
            'anterior'=>$emergencia->previousPageUrl(),
            'data'=>$emergencia->items(),
        ], 200);*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmergenciaStoreRequest $request)
    {   
        DB::beginTransaction();
        try {        
            $eDetalleRequest = new EmergenciaDetalleStoreRequest;
            $emergencia = Emergencia::create($request->all());

            foreach($request->detalle as $detalle ) {
                $detalle['emergencia_id'] = $emergencia->id;
                $validator = Validator::make($detalle, $eDetalleRequest->rules());
        
                if ($validator->fails()) {
                   throw new \Exception("Error al ingresar el paciente en la emergencia");
                   break;
                } 

                $emergencia->detalle[] = EmergenciaDetalle::create($detalle);
            }
            DB::commit();

            return response()->json(
                [
                    'status' => 'ok',
                    'message' => 'Emergencia creada exitosamente!',
                    'data' => $emergencia
                ],
                201
            );

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'status' => 'failed',
                    'message' => 'La emergencia no pudo ser creada!',
                ],
                400
            );
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmergenciaUpdateRequest $request, $id)
    {
        //
        DB::beginTransaction();
        try {
            $eDetalleRequest = new EmergenciaDetalleStoreRequest;
            $emergencia = Emergencia::find($id);

            if (empty($emergencia)) {
                return response()->json([
                        'message' => 'Error al modificar la emergencia',
                        'status' => 'Not found',
                ], 404);
            }

            $emergencia->fill($request->all());
            $emergencia->save();

            EmergenciaDetalle::where(['emergencia_id' => $request->id])->delete();

            foreach($request->detalle as $detalle ) {
                $detalle['emergencia_id'] = $emergencia->id;
                $validator = Validator::make($detalle, $eDetalleRequest->rules());
        
                if ($validator->fails()) {
                   throw new \Exception("Error al ingresar el paciente en la emergencia");
                   break;
                } 

                $emergencia->detalle[] = EmergenciaDetalle::create($detalle);
            }


            DB::commit();
            return response()->json(
                [
                    'status' => 'ok',
                    'message' => 'Emergencia modificada exitosamente!',
                    'data' => $emergencia
                ],
                201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'status' => 'failed',
                    'message' => 'La emergencia no pudo ser modificada!',
                ],
                400
            );
        }
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
        $emergencia = Emergencia::find($id);
        
        if ( empty($emergencia) ) {
            return response()->json([
                'message' => 'Detalle de la emergencia',
                'status'=>'not found',
                'isSuccess' => false
            ],404);
        } 
        
        $emergencia->delete();
        
		// Se devuelve código 204 No Content.
		return response()->json([
            'message' => 'Emergencia eliminada exitosamente!',
            'isSuccess' => true,
        ], 200);

    }
}
