<?php

namespace App\Http\Controllers\Api\Persona;

use App\Http\Controllers\AppBaseController;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Api\Persona\CreateFamiliaTipoApiRequest;
use App\Http\Requests\Api\Persona\UpdateFamiliaTipoApiRequest;
use App\Models\Persona\FamiliaTipo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class FamiliaTipoApiController
 */
class FamiliaTipoApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Familia Tipos', only: ['index']),
            new Middleware('permission:Ver Familia Tipos', only: ['show']),
            new Middleware('permission:Crear Familia Tipos', only: ['store']),
            new Middleware('permission:Editar Familia Tipos', only: ['update']),
            new Middleware('permission:Eliminar Familia Tipos', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Familia_tipos.
     * GET|HEAD /familia_tipos
     */
    public function index(Request $request): JsonResponse
    {
        $familia_tipos = QueryBuilder::for(FamiliaTipo::class)
            ->with([])
            ->allowedFilters([
                'nombre'
            ])
            ->allowedSorts([
                'nombre'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 10));

        return $this->sendResponse($familia_tipos->toArray(), 'familia_tipos recuperados con éxito.');
    }


    /**
     * Store a newly created FamiliaTipo in storage.
     * POST /familia_tipos
     */
    public function store(CreateFamiliaTipoApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $familia_tipos = FamiliaTipo::create($input);

        return $this->sendResponse($familia_tipos->toArray(), 'Tipo de Familia creado con éxito.');
    }


    /**
     * Display the specified FamiliaTipo.
     * GET|HEAD /familia_tipos/{id}
     */
    public function show(FamiliaTipo $tipo)
    {
        return $this->sendResponse($tipo->toArray(), 'Tipo de Familia recuperado con éxito.');
    }


    /**
     * Update the specified FamiliaTipo in storage.
     * PUT/PATCH /familia_tipos/{id}
     */
    public function update(UpdateFamiliaTipoApiRequest $request, $id): JsonResponse
    {
        $familiatipo = FamiliaTipo::findOrFail($id);
        $familiatipo->update($request->validated());
        return $this->sendResponse($familiatipo, 'Tipo de Familia actualizado con éxito.');
    }

    /**
     * Remove the specified FamiliaTipo from storage.
     * DELETE /familia_tipos/{id}
     */
    public function destroy(FamiliaTipo $tipo): JsonResponse
    {
        $tipo->delete();
        return $this->sendResponse(null, 'Tipo de Familia eliminado con éxito.');
    }

}
