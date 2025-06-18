<?php

namespace App\Http\Controllers\Api\Persona;

use App\Http\Controllers\AppBaseController;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Api\Persona\CreatePersonaBitacoraApiRequest;
use App\Http\Requests\Api\Persona\UpdatePersonaBitacoraApiRequest;
use App\Models\Persona\PersonaBitacora;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class PersonaBitacoraApiController
 */
class PersonaBitacoraApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Persona Bitacoras', only: ['index']),
            new Middleware('permission:Ver Persona Bitacoras', only: ['show']),
            new Middleware('permission:Crear Persona Bitacoras', only: ['store']),
            new Middleware('permission:Editar Persona Bitacoras', only: ['update']),
            new Middleware('permission:Eliminar Persona Bitacoras', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Persona_bitacoras.
     * GET|HEAD /persona_bitacoras
     */
    public function index(Request $request): JsonResponse
    {
        $persona_bitacoras = QueryBuilder::for(PersonaBitacora::class)
            ->with([])
            ->allowedFilters([
                'descripcion',
                'fecha_registro',
                'persona_id',
                'user_registra_id'
            ])
            ->allowedSorts([
                'descripcion',
                'fecha_registro',
                'persona_id',
                'user_registra_id'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 10));

        return $this->sendResponse($persona_bitacoras->toArray(), 'persona_bitacoras recuperados con éxito.');
    }

    /**
     * Store a newly created PersonaBitacora in storage.
     * POST /persona_bitacoras
     */
    public function store(CreatePersonaBitacoraApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $persona_bitacoras = PersonaBitacora::create($input);

        return $this->sendResponse($persona_bitacoras->toArray(), 'Bitácora creado con éxito.');
    }

    /**
     * Display the specified PersonaBitacora.
     * GET|HEAD /persona_bitacoras/{id}
     */
    public function show(PersonaBitacora $bitacora)
    {
        return $this->sendResponse($bitacora->toArray(), 'Bitácora recuperado con éxito.');
    }

    /**
     * Update the specified PersonaBitacora in storage.
     * PUT/PATCH /persona_bitacoras/{id}
     */
    public function update(UpdatePersonaBitacoraApiRequest $request, $id): JsonResponse
    {
        $personabitacora = PersonaBitacora::findOrFail($id);
        $personabitacora->update($request->validated());
        return $this->sendResponse($personabitacora, 'Bitácora actualizado con éxito.');
    }

    /**
     * Remove the specified PersonaBitacora from storage.
     * DELETE /persona_bitacoras/{id}
     */
    public function destroy(PersonaBitacora $bitacora): JsonResponse
    {
        $bitacora->delete();
        return $this->sendResponse(null, 'Bitácora eliminado con éxito.');
    }

}
