<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Api\Emergencia;
use App\Models\Api\EmergenciaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class EmergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emergencia = Cache::remember('cacheemergencia',15/60, function() {
			return Emergencia::simplePaginate(20);  // Paginamos cada 20 elementos.
        });
        
		return response()->json([
            'message' => 'Emergencia list',
            'status'=>'ok',
            'totalRecords' => sizeOf($emergencia->items()),
            'siguiente'=>$emergencia->nextPageUrl(),
            'anterior'=>$emergencia->previousPageUrl(),
            'data'=>$emergencia->items(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        DB::beginTransaction();

        try {       
            $persona = Emergencia::create($request->all());
                
            return response()->json([
                'status' => 'ok',
                'message' => 'Persona creado exitosamente!',
                'data'=> $persona]
            ,201);
        } catch (\Exception $e) {
                DB::rollback();
                throw $e;
        }
    }
    // DB::beginTransaction();
    
    // try {
    //     $post->comments()->save($comment);
        
    //     $post->last_comment_at = now();
    //     $post->save();
    
    //     DB::commit();
    // } catch (\Exception $e) {
    //     DB::rollback();
    //     throw $e;
    // } catch (\Throwable $e) {
    //     DB::rollback();
    //     throw $e;
    // }

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
    public function update(Request $request, $id)
    {
        //
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