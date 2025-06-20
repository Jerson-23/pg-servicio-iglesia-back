<?php

namespace App\Http\Controllers\Api\Congregacion;

use App\Http\Controllers\AppBaseController;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Api\Congregacion\CreateBautizoApiRequest;
use App\Http\Requests\Api\Congregacion\UpdateBautizoApiRequest;
use App\Models\Congregacion\Bautizo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class BautizoApiController
 */
class BautizoApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Bautizos', only: ['index']),
            new Middleware('permission:Ver Bautizos', only: ['show']),
            new Middleware('permission:Crear Bautizos', only: ['store']),
            new Middleware('permission:Editar Bautizos', only: ['update']),
            new Middleware('permission:Eliminar Bautizos', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Bautisos.
     * GET|HEAD /bautisos
     */
    public function index(Request $request): JsonResponse
    {
        $bautisos = QueryBuilder::for(Bautizo::class)
            ->with([])
            ->allowedFilters([
                'observaciones',
                'fecha_bautiso',
                'persona_id',
                'user_registra_id',
                'iglesia_id'
            ])
            ->allowedSorts([
                'observaciones',
                'fecha_bautiso',
                'persona_id',
                'user_registra_id',
                'iglesia_id'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 10));

        return $this->sendResponse($bautisos->toArray(), 'bautisos recuperados con éxito.');
    }

    /**
     * Store a newly created Bautizo in storage.
     * POST /bautisos
     */
    public function store(CreateBautizoApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $bautisos = Bautizo::create($input);

        return $this->sendResponse($bautisos->toArray(), 'Bautizo creado con éxito.');
    }

    /**
     * Display the specified Bautizo.
     * GET|HEAD /bautisos/{id}
     */
    public function show(Bautizo $bautizo)
    {
        return $this->sendResponse($bautizo->toArray(), 'Bautizo recuperado con éxito.');
    }

    /**
     * Update the specified Bautizo in storage.
     * PUT/PATCH /bautisos/{id}
     */
    public function update(UpdateBautizoApiRequest $request, $id): JsonResponse
    {
        $bautizo = Bautizo::findOrFail($id);
        $bautizo->update($request->validated());
        return $this->sendResponse($bautizo, 'Bautizo actualizado con éxito.');
    }

    /**
     * Remove the specified Bautizo from storage.
     * DELETE /bautisos/{id}
     */
    public function destroy(Bautizo $bautizo): JsonResponse
    {
        $bautizo->delete();
        return $this->sendResponse(null, 'Bautizo eliminado con éxito.');
    }

}
