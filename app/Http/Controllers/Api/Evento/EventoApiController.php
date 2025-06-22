<?php

namespace App\Http\Controllers\Api\Evento;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Evento\CreateEventoApiRequest;
use App\Http\Requests\Api\Evento\UpdateEventoApiRequest;
use App\Models\Evento\Evento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class EventoApiController
 */
class EventoApiController extends AppbaseController implements HasMiddleware
{

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Eventos', only: ['index']),
            new Middleware('permission:Ver Eventos', only: ['show']),
            new Middleware('permission:Crear Eventos', only: ['store']),
            new Middleware('permission:Editar Eventos', only: ['update']),
            new Middleware('permission:Eliminar Eventos', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Eventos.
     * GET|HEAD /eventos
     */
    public function index(Request $request): JsonResponse
    {
        $eventos = QueryBuilder::for(Evento::class)
            ->allowedFilters([
                'nombre',
                'descripcion',
                'tipo_id',
                'fecha',
                'hora',
                'direccion'
            ])
            ->allowedSorts([
                'nombre',
                'descripcion',
                'tipo_id',
                'fecha',
                'hora',
                'direccion'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 10));

        return $this->sendResponse($eventos->toArray(), 'eventos recuperados con éxito.');
    }

    /**
     * Store a newly created Evento in storage.
     * POST /eventos
     */
    public function store(CreateEventoApiRequest $request): JsonResponse
    {
        $input = $request->all();

        $eventos = Evento::create($input);

        return $this->sendResponse($eventos->toArray(), 'Evento creado con éxito.');
    }

    /**
     * Display the specified Evento.
     * GET|HEAD /eventos/{id}
     */
    public function show(Evento $evento)
    {
        $evento->load([
            'tipo',
            'iglesia',
            'participantes'
        ]);

        return $this->sendResponse($evento->toArray(), 'Evento recuperado con éxito.');
    }

    /**
     * Update the specified Evento in storage.
     * PUT/PATCH /eventos/{id}
     */
    public function update(UpdateEventoApiRequest $request, $id): JsonResponse
    {
        $evento = Evento::findOrFail($id);
        $evento->update($request->validated());
        return $this->sendResponse($evento, 'Evento actualizado con éxito.');
    }

    /**
     * Remove the specified Evento from storage.
     * DELETE /eventos/{id}
     */
    public function destroy(Evento $evento): JsonResponse
    {
        $evento->delete();
        return $this->sendResponse(null, 'Evento eliminado con éxito.');
    }


    public function marcarAsistencia(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'persona_id' => 'required|exists:personas,id',
        ]);

        DB::beginTransaction();

        try {
            $evento = Evento::findOrFail($request->input('evento_id'));

            // Evitar duplicados
            if ($evento->participantes()->where('personas.id', $request->persona_id)->exists()) {
                return $this->sendError('Esta persona ya fue registrada como asistente.', 409);
            }

            $evento->participantes()->attach($request->persona_id);

            DB::commit();

            return $this->sendSuccess('Asistencia marcada con éxito.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->sendError('Error al registrar asistencia.', 500);
        }
    }
    public function quitarAsistencia(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'persona_id' => 'required|exists:personas,id',
        ]);

        DB::beginTransaction();

        try {
            $evento = Evento::findOrFail($request->input('evento_id'));

            if (! $evento->participantes()->where('personas.id', $request->persona_id)->exists()) {
                return $this->sendError('Esta persona no está registrada como asistente.', 404);
            }

            $evento->participantes()->detach($request->persona_id);

            DB::commit();

            return $this->sendSuccess('Asistencia retirada con éxito.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->sendError('Error al quitar asistencia.', 500, $e->getMessage());
        }
    }


}
