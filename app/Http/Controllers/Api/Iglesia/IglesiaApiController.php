<?php

namespace App\Http\Controllers\Api\Iglesia;

use App\Http\Controllers\AppBaseController;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Api\Iglesia\CreateIglesiaApiRequest;
use App\Http\Requests\Api\Iglesia\UpdateIglesiaApiRequest;
use App\Models\Iglesia\Iglesia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class IglesiaApiController
 */
class IglesiaApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Iglesias', only: ['index']),
            new Middleware('permission:Ver Iglesias', only: ['show']),
            new Middleware('permission:Crear Iglesias', only: ['store']),
            new Middleware('permission:Editar Iglesias', only: ['update']),
            new Middleware('permission:Eliminar Iglesias', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Iglesias.
     * GET|HEAD /iglesias
     */
    public function index(Request $request): JsonResponse
    {
        $iglesias = QueryBuilder::for(Iglesia::class)
            ->with([])
            ->allowedFilters([
                'nombre',
                'direccion',
                'pastor_id'
            ])
            ->allowedSorts([
                'nombre',
                'direccion',
                'pastor_id'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 10));

        return $this->sendResponse($iglesias->toArray(), 'iglesias recuperados con éxito.');
    }

    /**
     * Store a newly created Iglesia in storage.
     * POST /iglesias
     */
    public function store(CreateIglesiaApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $iglesias = Iglesia::create($input);

        return $this->sendResponse($iglesias->toArray(), 'Iglesia creado con éxito.');
    }

    /**
     * Display the specified Iglesia.
     * GET|HEAD /iglesias/{id}
     */
    public function show(Iglesia $iglesia)
    {
        return $this->sendResponse($iglesia->toArray(), 'Iglesia recuperado con éxito.');
    }

    /**
     * Update the specified Iglesia in storage.
     * PUT/PATCH /iglesias/{id}
     */
    public function update(UpdateIglesiaApiRequest $request, $id): JsonResponse
    {
        $iglesia = Iglesia::findOrFail($id);
        $iglesia->update($request->validated());
        return $this->sendResponse($iglesia, 'Iglesia actualizado con éxito.');
    }

    /**
     * Remove the specified Iglesia from storage.
     * DELETE /iglesias/{id}
     */
    public function destroy(Iglesia $iglesia): JsonResponse
    {
        $iglesia->delete();
        return $this->sendResponse(null, 'Iglesia eliminado con éxito.');
    }

}
