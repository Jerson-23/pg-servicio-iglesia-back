<?php

namespace App\Http\Controllers\Api\Persona;

use App\Http\Controllers\AppBaseController;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Api\Persona\CreatePersonaApiRequest;
use App\Http\Requests\Api\Persona\UpdatePersonaApiRequest;
use App\Models\Persona\Persona;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class PersonaApiController
 */
class PersonaApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Personas', only: ['index']),
            new Middleware('permission:Ver Personas', only: ['show']),
            new Middleware('permission:Crear Personas', only: ['store']),
            new Middleware('permission:Editar Personas', only: ['update']),
            new Middleware('permission:Eliminar Personas', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Personas.
     * GET|HEAD /personas
     */
    public function index(Request $request): JsonResponse
    {
        $personas = QueryBuilder::for(Persona::class)
            ->allowedFilters([
                'primer_nombre',
                'segundo_nombre',
                'primer_apellido',
                'segundo_apellido',
                'telefono',
                'direccion',
                'email',
                'ministerio_id',
                'estado_id',
                'fecha_nacimiento',
                'correlativo',
                'dpi',
                'nivel_academico_id',
                'genero_id'
            ])
            ->allowedSorts([
                'primer_nombre',
                'segundo_nombre',
                'primer_apellido',
                'segundo_apellido',
                'telefono',
                'direccion',
                'email',
                'ministerio_id',
                'estado_id',
                'fecha_nacimiento',
                'correlativo',
                'dpi',
                'nivel_academico_id',
                'genero_id'
            ])
            ->allowedIncludes([
                'ministerio',
                'estado',
                'nivelAcademico',
                'genero'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 10));

        return $this->sendResponse($personas->toArray(), 'personas recuperados con éxito.');
    }

    /**
     * Store a newly created Persona in storage.
     * POST /personas
     */
    public function store(CreatePersonaApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $personas = Persona::create($input);

        return $this->sendResponse($personas->toArray(), 'Persona creado con éxito.');
    }

    /**
     * Display the specified Persona.
     * GET|HEAD /personas/{id}
     */
    public function show(Persona $persona)
    {
        return $this->sendResponse($persona->toArray(), 'Persona recuperado con éxito.');
    }

    /**
     * Update the specified Persona in storage.
     * PUT/PATCH /personas/{id}
     */
    public function update(UpdatePersonaApiRequest $request, $id): JsonResponse
    {
        $persona = Persona::findOrFail($id);
        $persona->update($request->validated());
        return $this->sendResponse($persona, 'Persona actualizado con éxito.');
    }

    /**
     * Remove the specified Persona from storage.
     * DELETE /personas/{id}
     */
    public function destroy(Persona $persona): JsonResponse
    {
        $persona->delete();
        return $this->sendResponse(null, 'Persona eliminado con éxito.');
    }

}
