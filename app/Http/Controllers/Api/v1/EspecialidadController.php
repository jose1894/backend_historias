<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\EspecialidadStoreRequest;
use App\Http\Requests\Api\v1\EspecialidadUpdateRequest;
use App\Models\Api\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidad = Cache::remember('cacheespecialidad',15/60, function() {
			return Especialidad::simplePaginate(20);  // Paginamos cada 20 elementos.
        });
        
		return response()->json([
            'message' => 'Especialidad list',
            'status'=>'ok',
            'totalRecords' => sizeOf($especialidad->items()),
            'siguiente'=>$especialidad->nextPageUrl(),
            'anterior'=>$especialidad->previousPageUrl(),
            'data'=>$especialidad->items(),
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspecialidadStoreRequest $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EspecialidadUpdateRequest $request, $id)
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
