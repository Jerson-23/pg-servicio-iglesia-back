<?php

namespace App\Http\Controllers\Api\Ministerio;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Ministerio\CreateMinisterioApiRequest;
use App\Http\Requests\Api\Ministerio\UpdateMinisterioApiRequest;
use App\Models\Ministerio\Ministerio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class MinisterioApiController
 */
class MinisterioApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Ministerios', only: ['index']),
            new Middleware('permission:Ver Ministerios', only: ['show']),
            new Middleware('permission:Crear Ministerios', only: ['store']),
            new Middleware('permission:Editar Ministerios', only: ['update']),
            new Middleware('permission:Eliminar Ministerios', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Ministerios.
     * GET|HEAD /ministerios
     */
    public function index(Request $request): JsonResponse
    {
        $ministerios = QueryBuilder::for(Ministerio::class)
            ->with([])
            ->allowedFilters([
                'nombre'
            ])
            ->allowedSorts([
                'nombre'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 250));

        return $this->sendResponse($ministerios->toArray(), 'ministerios recuperados con éxito.');
    }


    /**
     * Store a newly created Ministerio in storage.
     * POST /ministerios
     */
    public function store(CreateMinisterioApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $ministerios = Ministerio::create($input);

        return $this->sendResponse($ministerios->toArray(), 'Ministerio creado con éxito.');
    }

    /**
     * Display the specified Ministerio.
     * GET|HEAD /ministerios/{id}
     */
    public function show(Ministerio $ministerio)
    {
        return $this->sendResponse($ministerio->toArray(), 'Ministerio recuperado con éxito.');
    }

    /**
     * Update the specified Ministerio in storage.
     * PUT/PATCH /ministerios/{id}
     */
    public function update(UpdateMinisterioApiRequest $request, $id): JsonResponse
    {
        $ministerio = Ministerio::findOrFail($id);
        $ministerio->update($request->validated());
        return $this->sendResponse($ministerio, 'Ministerio actualizado con éxito.');
    }

    /**
     * Remove the specified Ministerio from storage.
     * DELETE /ministerios/{id}
     */
    public function destroy(Ministerio $ministerio): JsonResponse
    {
        $ministerio->delete();
        return $this->sendResponse(null, 'Ministerio eliminado con éxito.');
    }


}
