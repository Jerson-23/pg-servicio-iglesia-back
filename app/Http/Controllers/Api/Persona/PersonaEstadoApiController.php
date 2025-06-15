<?php

namespace App\Http\Controllers\Api\Persona;

use App\Http\Controllers\AppBaseController;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Api\Persona\CreatePersonaEstadoApiRequest;
use App\Http\Requests\Api\Persona\UpdatePersonaEstadoApiRequest;
use App\Models\Persona\PersonaEstado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class PersonaEstadoApiController
 */
class PersonaEstadoApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Persona Estados', only: ['index']),
            new Middleware('permission:Ver Persona Estados', only: ['show']),
            new Middleware('permission:Crear Persona Estados', only: ['store']),
            new Middleware('permission:Editar Persona Estados', only: ['update']),
            new Middleware('permission:Eliminar Persona Estados', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Persona_estados.
     * GET|HEAD /persona_estados
     */
    public function index(Request $request): JsonResponse
    {
        $persona_estados = QueryBuilder::for(PersonaEstado::class)
            ->with([])
            ->allowedFilters([
                'nombre'
            ])
            ->allowedSorts([
                'nombre'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 10));

        return $this->sendResponse($persona_estados->toArray(), '=Estados recuperados con éxito.');
    }


    /**
     * Store a newly created PersonaEstado in storage.
     * POST /persona_estados
     */
    public function store(CreatePersonaEstadoApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $persona_estados = PersonaEstado::create($input);

        return $this->sendResponse($persona_estados->toArray(), '=Estado creado con éxito.');
    }


    /**
     * Display the specified PersonaEstado.
     * GET|HEAD /persona_estados/{id}
     */
    public function show(PersonaEstado $estado)
    {
        return $this->sendResponse($estado->toArray(), '=Estado recuperado con éxito.');
    }


    /**
     * Update the specified PersonaEstado in storage.
     * PUT/PATCH /persona_estados/{id}
     */
    public function update(UpdatePersonaEstadoApiRequest $request, $id): JsonResponse
    {
        $personaestado = PersonaEstado::findOrFail($id);
        $personaestado->update($request->validated());
        return $this->sendResponse($personaestado, '=Estado actualizado con éxito.');
    }

    /**
     * Remove the specified PersonaEstado from storage.
     * DELETE /persona_estados/{id}
     */
    public function destroy(PersonaEstado $estado): JsonResponse
    {
        $estado->delete();
        return $this->sendResponse(null, '=Estado eliminado con éxito.');
    }


}
