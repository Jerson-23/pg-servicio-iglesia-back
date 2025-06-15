<?php

namespace App\Http\Controllers\Api\Persona;

use App\Http\Controllers\AppBaseController;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Api\Persona\CreatePersonaGeneroApiRequest;
use App\Http\Requests\Api\Persona\UpdatePersonaGeneroApiRequest;
use App\Models\Persona\PersonaGenero;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class PersonaGeneroApiController
 */
class PersonaGeneroApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Persona Generos', only: ['index']),
            new Middleware('permission:Ver Persona Generos', only: ['show']),
            new Middleware('permission:Crear Persona Generos', only: ['store']),
            new Middleware('permission:Editar Persona Generos', only: ['update']),
            new Middleware('permission:Eliminar Persona Generos', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Persona_generos.
     * GET|HEAD /persona_generos
     */
    public function index(Request $request): JsonResponse
    {
        $persona_generos = QueryBuilder::for(PersonaGenero::class)
            ->with([])
            ->allowedFilters([
                'nombre'
            ])
            ->allowedSorts([
                'nombre'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 10));

        return $this->sendResponse($persona_generos->toArray(), 'Generos recuperados con éxito.');
    }


    /**
     * Store a newly created PersonaGenero in storage.
     * POST /persona_generos
     */
    public function store(CreatePersonaGeneroApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $persona_generos = PersonaGenero::create($input);

        return $this->sendResponse($persona_generos->toArray(), 'Genero creado con éxito.');
    }


    /**
     * Display the specified PersonaGenero.
     * GET|HEAD /persona_generos/{id}
     */
    public function show(PersonaGenero $genero)
    {
        return $this->sendResponse($genero->toArray(), 'Genero recuperado con éxito.');
    }


    /**
     * Update the specified PersonaGenero in storage.
     * PUT/PATCH /persona_generos/{id}
     */
    public function update(UpdatePersonaGeneroApiRequest $request, $id): JsonResponse
    {
        $personagenero = PersonaGenero::findOrFail($id);
        $personagenero->update($request->validated());
        return $this->sendResponse($personagenero, 'Genero actualizado con éxito.');
    }

    /**
     * Remove the specified PersonaGenero from storage.
     * DELETE /persona_generos/{id}
     */
    public function destroy(PersonaGenero $genero): JsonResponse
    {
        $genero->delete();
        return $this->sendResponse(null, 'Genero eliminado con éxito.');
    }

}
