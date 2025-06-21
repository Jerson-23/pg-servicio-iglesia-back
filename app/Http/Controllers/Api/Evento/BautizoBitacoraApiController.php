<?php

namespace App\Http\Controllers\Api\Evento;

use App\Http\Controllers\AppBaseController;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Api\Evento\CreateBautizoBitacoraApiRequest;
use App\Http\Requests\Api\Evento\UpdateBautizoBitacoraApiRequest;
use App\Models\Evento\BautizoBitacora;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class BautizoBitacoraApiController
 */
class BautizoBitacoraApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Bautizo Bitacoras', only: ['index']),
            new Middleware('permission:Ver Bautizo Bitacoras', only: ['show']),
            new Middleware('permission:Crear Bautizo Bitacoras', only: ['store']),
            new Middleware('permission:Editar Bautizo Bitacoras', only: ['update']),
            new Middleware('permission:Eliminar Bautizo Bitacoras', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Bautiso_bitacoras.
     * GET|HEAD /bautiso_bitacoras
     */
    public function index(Request $request): JsonResponse
    {
        $bautiso_bitacoras = QueryBuilder::for(BautizoBitacora::class)
            ->allowedFilters([
                'descripcion',
                'fecha_registro',
                'bautiso_id',
                'user_registra_id'
            ])
            ->allowedSorts([
                'descripcion',
                'fecha_registro',
                'bautiso_id',
                'user_registra_id'
            ])
            ->allowedIncludes(['bautizo.persona', 'userRegistra'])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 10));

        return $this->sendResponse($bautiso_bitacoras->toArray(), 'Bitácoras recuperados con éxito.');
    }

    /**
     * Store a newly created BautizoBitacora in storage.
     * POST /bautiso_bitacoras
     */
    public function store(CreateBautizoBitacoraApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $bautiso_bitacoras = BautizoBitacora::create($input);

        return $this->sendResponse($bautiso_bitacoras->toArray(), 'Bitácora creado con éxito.');
    }

    /**
     * Display the specified BautizoBitacora.
     * GET|HEAD /bautiso_bitacoras/{id}
     */
    public function show(BautizoBitacora $bitacora)
    {
        return $this->sendResponse($bitacora->toArray(), 'Bitácora recuperado con éxito.');
    }

    /**
     * Update the specified BautizoBitacora in storage.
     * PUT/PATCH /bautiso_bitacoras/{id}
     */
    public function update(UpdateBautizoBitacoraApiRequest $request, $id): JsonResponse
    {
        $bautizobitacora = BautizoBitacora::findOrFail($id);
        $bautizobitacora->update($request->validated());
        return $this->sendResponse($bautizobitacora, 'Bitácora actualizado con éxito.');
    }

    /**
     * Remove the specified BautizoBitacora from storage.
     * DELETE /bautiso_bitacoras/{id}
     */
    public function destroy(BautizoBitacora $bitacora): JsonResponse
    {
        $bitacora->delete();
        return $this->sendResponse(null, 'Bitácora eliminado con éxito.');
    }

}
