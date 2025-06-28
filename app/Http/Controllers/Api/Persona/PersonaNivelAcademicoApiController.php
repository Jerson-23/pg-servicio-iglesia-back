<?php

namespace App\Http\Controllers\Api\Persona;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Persona\CreatePersonaNivelAcademicoApiRequest;
use App\Http\Requests\Api\Persona\UpdatePersonaNivelAcademicoApiRequest;
use App\Models\Persona\PersonaNivelAcademico;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class PersonaNivelAcademicoApiController
 */
class PersonaNivelAcademicoApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Persona Nivel Academicos', only: ['index']),
            new Middleware('permission:Ver Persona Nivel Academicos', only: ['show']),
            new Middleware('permission:Crear Persona Nivel Academicos', only: ['store']),
            new Middleware('permission:Editar Persona Nivel Academicos', only: ['update']),
            new Middleware('permission:Eliminar Persona Nivel Academicos', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Persona_niveles_academicos.
     * GET|HEAD /persona_niveles_academicos
     */
    public function index(Request $request): JsonResponse
    {
        $persona_niveles_academicos = QueryBuilder::for(PersonaNivelAcademico::class)
            ->with([])
            ->allowedFilters([
                'nombre'
            ])
            ->allowedSorts([
                'nombre'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 250));

        return $this->sendResponse($persona_niveles_academicos->toArray(),
            'persona_niveles_academicos recuperados con éxito.');
    }


    /**
     * Store a newly created PersonaNivelAcademico in storage.
     * POST /persona_niveles_academicos
     */
    public function store(CreatePersonaNivelAcademicoApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $persona_niveles_academicos = PersonaNivelAcademico::create($input);

        return $this->sendResponse($persona_niveles_academicos->toArray(), 'PersonaNivelAcademico creado con éxito.');
    }


    /**
     * Display the specified PersonaNivelAcademico.
     * GET|HEAD /persona_niveles_academicos/{id}
     */
    public function show(PersonaNivelAcademico $academico)
    {
        return $this->sendResponse($academico->toArray(), 'PersonaNivelAcademico recuperado con éxito.');
    }


    /**
     * Update the specified PersonaNivelAcademico in storage.
     * PUT/PATCH /persona_niveles_academicos/{id}
     */
    public function update(UpdatePersonaNivelAcademicoApiRequest $request, $id): JsonResponse
    {
        $personanivelacademico = PersonaNivelAcademico::findOrFail($id);
        $personanivelacademico->update($request->validated());
        return $this->sendResponse($personanivelacademico, 'PersonaNivelAcademico actualizado con éxito.');
    }

    /**
     * Remove the specified PersonaNivelAcademico from storage.
     * DELETE /persona_niveles_academicos/{id}
     */
    public function destroy(PersonaNivelAcademico $academico): JsonResponse
    {
        $academico->delete();
        return $this->sendResponse(null, 'PersonaNivelAcademico eliminado con éxito.');
    }


}
