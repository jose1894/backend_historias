<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signUp');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::post('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
        Route::group([
            'prefix' => 'v1', 
            'namespace' => 'Api\v1'
            ], function () {
                Route::resource('paciente', 'PacienteController',[ 'except' => ['edit','create']]);
                Route::resource('persona', 'PersonaController',[ 'except' => ['edit','create']]);
                Route::resource('pais', 'PaisController',[ 'except' => ['edit','create']]);
                Route::resource('area', 'AreaController',[ 'except' => ['edit','create']]);
                Route::resource('especialidad', 'EspecialidadController',[ 'except' => ['edit','create']]);
                Route::resource('tipopersona', 'TipoPersonaController',[ 'except' => ['edit','create']]);
                Route::resource('motivoingreso', MotivoIngresoController::class,[ 'except' => ['edit','create']]);
                Route::resource('diagnostico', DiagnosticoController::class,[ 'except' => ['edit','create']]);
                Route::resource('pacienteEmergencia', PacienteEmergenciaController::class,[ 'except' => ['edit','create']]);
                // Route::resource('pacienteEmergenciaDetalle', 'PacienteEmergenciaDetalleController',[ 'except' => ['edit','create']]);
            });
    });
});
