<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user()->responseUser();
});

Route::middleware('auth:sanctum')->group(function () {

    require __DIR__.'/admin/api.php';


    Route::apiResource('ministerios', App\Http\Controllers\Api\Ministerio\MinisterioApiController::class);

    Route::apiResource('persona/estados', App\Http\Controllers\Api\Persona\PersonaEstadoApiController::class);

    Route::apiResource('persona/nivel/academicos', App\Http\Controllers\Api\Persona\PersonaNivelAcademicoApiController::class);

    Route::apiResource('persona/generos', App\Http\Controllers\Api\Persona\PersonaGeneroApiController::class);

    Route::apiResource('persona/familias', App\Http\Controllers\Api\Persona\FamiliaApiController::class);

    Route::post('persona/familia/agregar/miembro', [App\Http\Controllers\Api\Persona\FamiliaApiController::class, 'agregarMiembro']);

    Route::post('persona/familia/eliminar/miembro', [App\Http\Controllers\Api\Persona\FamiliaApiController::class, 'eliminarMiembro']);

    Route::apiResource('evento/tipos', App\Http\Controllers\Api\Evento\EventoTipoApiController::class);

    Route::apiResource('persona/familia/tipos', App\Http\Controllers\Api\Persona\FamiliaTipoApiController::class);

    Route::apiResource('iglesias', App\Http\Controllers\Api\Iglesia\IglesiaApiController::class);

    Route::apiResource('personas', App\Http\Controllers\Api\Persona\PersonaApiController::class);

    Route::apiResource('persona/bitacoras', App\Http\Controllers\Api\Persona\PersonaBitacoraApiController::class);

    Route::apiResource('bautizos/bitacoras', App\Http\Controllers\Api\Evento\BautizoBitacoraApiController::class);

    Route::apiResource('bautizos', App\Http\Controllers\Api\Congregacion\BautizoApiController::class);

    Route::apiResource('eventos', App\Http\Controllers\Api\Evento\EventoApiController::class);

    Route::post('eventos/marcar/asistencia', [App\Http\Controllers\Api\Evento\EventoApiController::class, 'marcarAsistencia']);

    Route::post('/eventos/quitar/asistencia', [App\Http\Controllers\Api\Evento\EventoApiController::class, 'quitarAsistencia']);

});

require __DIR__.'/auth.php';

Route::prefix('libres')->group(function () {

    require __DIR__.'/admin/Configuraciones/api_libres.php';

});




