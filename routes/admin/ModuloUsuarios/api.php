<?php


use Illuminate\Support\Facades\Route;

Route::prefix('modulo-usuarios')->group(function () {

    Route::prefix('roles')->group(function () {

        Route::get('all', [\App\Http\Controllers\Api\admin\ModuloUsuarios\RolApiController::class, 'obtenerTodos']);

        Route::post('asignar/permisos/{rol}', [\App\Http\Controllers\Api\admin\ModuloUsuarios\RolApiController::class, 'asignarPermisosARol']);

        Route::post('quitar/permisos/{rol}', [\App\Http\Controllers\Api\admin\ModuloUsuarios\RolApiController::class, 'quitarPermisosARol']);

        Route::get('obtener/permisos/asignados/{rol}', [\App\Http\Controllers\Api\admin\ModuloUsuarios\RolApiController::class, 'obtenerPermisosAsignados']);

    });

    Route::apiResource('roles', \App\Http\Controllers\Api\admin\ModuloUsuarios\RolApiController::class)
        ->parameters(['roles' => 'rol']);

    Route::prefix('permissions')->group(function () {

        Route::get('all', [\App\Http\Controllers\Api\admin\ModuloUsuarios\PermissionApiController::class, 'obtenerTodos']);

    });

    Route::apiResource('permissions', \App\Http\Controllers\Api\admin\ModuloUsuarios\PermissionApiController::class)
        ->parameters(['permissions' => 'permission']);

    Route::prefix('users')->group(function () {

        Route::resource('estados', \App\Http\Controllers\Api\admin\ModuloUsuarios\UserEstadoApiController::class);

        Route::get('obtener/roles/deUser/{user}', [\App\Http\Controllers\Api\admin\ModuloUsuarios\UserApiController::class, 'obtenerRolesDeUser']);

        Route::post('asignar/rol/aUser', [\App\Http\Controllers\Api\admin\ModuloUsuarios\UserApiController::class, 'asignarRolAUser']);

        Route::post('quitar/rol/aUser', [\App\Http\Controllers\Api\admin\ModuloUsuarios\UserApiController::class, 'quitarRolAUser']);

        Route::get('get/data/perfil/{user}', [\App\Http\Controllers\Api\admin\ModuloUsuarios\UserApiController::class, 'getDataPerfil']);

        Route::post('actualizar/foto/perfil/{user}', [\App\Http\Controllers\Api\admin\ModuloUsuarios\UserApiController::class, 'actualizarFotoPerfil']);

    });

    Route::apiResource('users', \App\Http\Controllers\Api\admin\ModuloUsuarios\UserApiController::class);

});

