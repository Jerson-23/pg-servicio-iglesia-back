<?php

namespace App\Http\Controllers\Api\Persona;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Persona\CreateProfesionApiRequest;
use App\Http\Requests\Api\Persona\UpdateProfesionApiRequest;
use App\Models\Persona\Profesion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class ProfesionApiController
 */
class ProfesionApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Profesiones', only: ['index']),
            new Middleware('permission:Ver Profesiones', only: ['show']),
            new Middleware('permission:Crear Profesiones', only: ['store']),
            new Middleware('permission:Editar Profesiones', only: ['update']),
            new Middleware('permission:Eliminar Profesiones', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Profesiones.
     * GET|HEAD /profesiones
     */
    public function index(Request $request): JsonResponse
    {
        $profesiones = QueryBuilder::for(Profesion::class)
            ->with([])
            ->allowedFilters([
                'nombre'
            ])
            ->allowedSorts([
                'nombre'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 10));

        return $this->sendResponse($profesiones->toArray(), 'profesiones recuperados con éxito.');
    }

    /**
     * Store a newly created Profesion in storage.
     * POST /profesiones
     */
    public function store(CreateProfesionApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $profesiones = Profesion::create($input);

        return $this->sendResponse($profesiones->toArray(), 'Profesion creado con éxito.');
    }

    /**
     * Display the specified Profesion.
     * GET|HEAD /profesiones/{id}
     */
    public function show(Profesion $profesion)
    {
        return $this->sendResponse($profesion->toArray(), 'Profesion recuperado con éxito.');
    }

    /**
     * Update the specified Profesion in storage.
     * PUT/PATCH /profesiones/{id}
     */
    public function update(UpdateProfesionApiRequest $request, $id): JsonResponse
    {
        $profesion = Profesion::findOrFail($id);
        $profesion->update($request->validated());
        return $this->sendResponse($profesion, 'Profesion actualizado con éxito.');
    }

    /**
     * Remove the specified Profesion from storage.
     * DELETE /profesiones/{id}
     */
    public function destroy(Profesion $profesion): JsonResponse
    {
        $profesion->delete();
        return $this->sendResponse(null, 'Profesion eliminado con éxito.');
    }

}
