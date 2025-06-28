<?php

namespace App\Http\Controllers\Api\Evento;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Evento\CreateEventoTipoApiRequest;
use App\Http\Requests\Api\Evento\UpdateEventoTipoApiRequest;
use App\Models\Evento\EventoTipo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class EventoTipoApiController
 */
class EventoTipoApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Evento Tipos', only: ['index']),
            new Middleware('permission:Ver Evento Tipos', only: ['show']),
            new Middleware('permission:Crear Evento Tipos', only: ['store']),
            new Middleware('permission:Editar Evento Tipos', only: ['update']),
            new Middleware('permission:Eliminar Evento Tipos', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Evento_tipos.
     * GET|HEAD /evento_tipos
     */
    public function index(Request $request): JsonResponse
    {
        $evento_tipos = QueryBuilder::for(EventoTipo::class)
            ->with([])
            ->allowedFilters([
                'nombre'
            ])
            ->allowedSorts([
                'nombre'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 250));

        return $this->sendResponse($evento_tipos->toArray(), 'Tipos recuperados con éxito.');
    }


    /**
     * Store a newly created EventoTipo in storage.
     * POST /evento_tipos
     */
    public function store(CreateEventoTipoApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $evento_tipos = EventoTipo::create($input);

        return $this->sendResponse($evento_tipos->toArray(), '=Tipo creado con éxito.');
    }


    /**
     * Display the specified EventoTipo.
     * GET|HEAD /evento_tipos/{id}
     */
    public function show(EventoTipo $tipo)
    {
        return $this->sendResponse($tipo->toArray(), '=Tipo recuperado con éxito.');
    }


    /**
     * Update the specified EventoTipo in storage.
     * PUT/PATCH /evento_tipos/{id}
     */
    public function update(UpdateEventoTipoApiRequest $request, $id): JsonResponse
    {
        $eventotipo = EventoTipo::findOrFail($id);
        $eventotipo->update($request->validated());
        return $this->sendResponse($eventotipo, '=Tipo actualizado con éxito.');
    }

    /**
     * Remove the specified EventoTipo from storage.
     * DELETE /evento_tipos/{id}
     */
    public function destroy(EventoTipo $tipo): JsonResponse
    {
        $tipo->delete();
        return $this->sendResponse(null, '=Tipo eliminado con éxito.');
    }


}
