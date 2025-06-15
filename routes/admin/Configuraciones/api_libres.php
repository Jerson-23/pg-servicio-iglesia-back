<?php

use App\Http\Controllers\Api\admin\Configuraciones\ConfiguracionApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('configuraciones')->group(function () {

    Route::get('generales', [ConfiguracionApiController::class, 'getConfiguracionesGenerales']);

});


