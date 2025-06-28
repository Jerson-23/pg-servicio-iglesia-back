<?php

namespace App\Http\Controllers\Api\Persona;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Persona\CreateFamiliaApiRequest;
use App\Http\Requests\Api\Persona\UpdateFamiliaApiRequest;
use App\Models\Persona\Familia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class FamiliaApiController
 */
class FamiliaApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Familias', only: ['index']),
            new Middleware('permission:Ver Familias', only: ['show']),
            new Middleware('permission:Crear Familias', only: ['store']),
            new Middleware('permission:Editar Familias', only: ['update']),
            new Middleware('permission:Eliminar Familias', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Familias.
     * GET|HEAD /familias
     */
    public function index(Request $request): JsonResponse
    {
        $familias = QueryBuilder::for(Familia::class)
            ->with([])
            ->allowedFilters([
                'nombre'
            ])
            ->allowedSorts([
                'nombre'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 250));

        return $this->sendResponse($familias->toArray(), 'familias recuperados con éxito.');
    }


    /**
     * Store a newly created Familia in storage.
     * POST /familias
     */
    public function store(CreateFamiliaApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $familias = Familia::create($input);

        if($input['personas'] ?? null) {
            $familias->personas()->sync($input['personas']);
        }

        return $this->sendResponse($familias->toArray(), 'Familia creado con éxito.');
    }


    /**
     * Display the specified Familia.
     * GET|HEAD /familias/{id}
     */
    public function show(Familia $familia)
    {
        $familia->load('personas.familias');
        return $this->sendResponse($familia->toArray(), 'Familia recuperado con éxito.');
    }


    /**
     * Update the specified Familia in storage.
     * PUT/PATCH /familias/{id}
     */
    public function update(UpdateFamiliaApiRequest $request, $id): JsonResponse
    {
        $familia = Familia::findOrFail($id);
        $familia->update($request->validated());
        return $this->sendResponse($familia, 'Familia actualizado con éxito.');
    }

    /**
     * Remove the specified Familia from storage.
     * DELETE /familias/{id}
     */
    public function destroy(Familia $familia): JsonResponse
    {
        $familia->delete();
        return $this->sendResponse(null, 'Familia eliminado con éxito.');
    }

    public function agregarMiembro(Request $request): JsonResponse
    {
        $request->validate([
            'familia_id' => 'required|exists:familias,id',
            'persona_id' => 'required|exists:personas,id',
            'tipo_id' => 'required|exists:familia_tipos,id',
        ]);

        $familia = Familia::findOrFail($request->familia_id);

        $familia
            ->personas()
            ->attach($request->persona_id, ['familia_tipos_id' => $request->tipo_id]);

        return $this->sendResponse($familia->toArray(), 'Miembro agregado a la familia con éxito.');

    }

    public function eliminarMiembro(Request $request): JsonResponse
    {
        $request->validate([
            'familia_id' => 'required|exists:familias,id',
            'persona_id' => 'required|exists:personas,id',
        ]);

        $familia = Familia::findOrFail($request->familia_id);

        $familia
            ->personas()
            ->detach($request->persona_id);

        return $this->sendResponse($familia->toArray(), 'Miembro eliminado de la familia con éxito.');
    }
}
