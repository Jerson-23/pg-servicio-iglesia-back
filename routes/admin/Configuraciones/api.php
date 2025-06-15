<?php


use App\Http\Controllers\Api\admin\Configuraciones\ConfiguracionApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('configuraciones')->group(function () {

    Route::prefix('menu-opciones')->group(function () {

        Route::post('menu-opcions/actualizar/orden', [\App\Http\Controllers\Api\admin\Configuraciones\MenuOpcionApiController::class, 'actualizarOrden'])->name('menu-opcions.getColumnas');

        Route::apiResource('/', \App\Http\Controllers\Api\admin\Configuraciones\MenuOpcionApiController::class)
        ->parameters(['' => 'menuOpcion']);

        Route::get('get/menu-opciones/', [\App\Http\Controllers\Api\admin\Configuraciones\MenuOpcionApiController::class, 'getOpcionesMenu']);

    });

    Route::prefix('generales')->group(function () {

        Route::post('guardar', [ConfiguracionApiController::class, 'guardarGenerales']);

        Route::apiResource('/', ConfiguracionApiController::class)
        ->parameters(['' => 'configuracion']);

    });

});
