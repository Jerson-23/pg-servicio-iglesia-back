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
            ->allowedIncludes([
                'tipo',
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 250));

        return $this->sendResponse($eventos->toArray(), 'eventos recuperados con éxito.');
    }

    /**
     * Store a newly created Evento in storage.
     * POST /eventos
     */
    public function store(CreateEventoApiRequest $request): JsonResponse
    {
        // Recopilar todos los datos validados del request
        $input = $request->all();

        // Iniciar una transacción para asegurar que todo se realice correctamente o nada se guarde
        DB::beginTransaction();

        try {
            // Crear el evento con los datos principales
            $evento = Evento::create($input);

            // Si hay ministerios asociados, sincronizarlos con la relación (tabla pivot)
            if (!empty($input['ministerios'])) {
                //Extraer los IDs de los ministerios del input
                $idsMinisterios = collect($input['ministerios'])->pluck('id')->toArray();
                // Sincronizar los ministerios con el evento
                $evento->ministerios()->sync($idsMinisterios);
                // Verificamos si se enviaron imágenes
            }
            if ($request->hasFile('imagenes')) {
                // Aseguramos que las imágenes sean un array
                foreach ($request->file('imagenes') as $imagen) {
                    // Guardamos cada imagen en la colección 'imagenes'
                    $evento->addMedia($imagen)
                        ->toMediaCollection('imagenesEventos');
                }
            }

            // Confirmar la transacción: todo se guarda permanentemente
            DB::commit();

            // Retornar respuesta exitosa
            return $this->sendResponse($evento->toArray(), 'Evento creado con éxito.');
        } catch (\Throwable $e) {
            // Si algo falla, deshacer cualquier cambio en la base de datos
            DB::rollBack();

            // Retornar un error con el mensaje de excepción (opcionalmente, podrías omitir el mensaje en producción)
            return $this->sendError('Error al crear el evento.'.$e->getMessage(), 500);
        }
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
            'participantes',
            'ministerios'
        ]);

        return $this->sendResponse($evento->toArray(), 'Evento recuperado con éxito.');
    }

    /**
     * Update the specified Evento in storage.
     * PUT/PATCH /eventos/{id}
     */
    public function update(UpdateEventoApiRequest $request, $id): JsonResponse
    {
        // Buscar el evento por ID
        $evento = Evento::findOrFail($id);

        // Recopilar todos los datos validados del request
        $input = $request->all();

        // Iniciar una transacción para asegurar que todo se realice correctamente o nada se guarde
        DB::beginTransaction();

        try {
            // Actualizar el evento con los datos principales
            $evento->update($input);

            // Si hay ministerios asociados, sincronizarlos con la relación (tabla pivot)
            if (!empty($input['ministerios'])) {
                // Extraer los IDs de los ministerios del input
                $idsMinisterios = collect($input['ministerios'])->pluck('id')->toArray();
                // Sincronizar los ministerios con el evento
                $evento->ministerios()->sync($idsMinisterios);
            }

            if ($request->hasFile('imagenes')) {
                // Aseguramos que las imágenes sean un array
                foreach ($request->file('imagenes') as $imagen) {
                    // Guardamos cada imagen en la colección 'imagenes'
                    $evento->addMedia($imagen)
                        ->toMediaCollection('imagenesEventos');
                }
            }

            // Confirmar la transacción: todo se guarda permanentemente
            DB::commit();

            // Retornar respuesta exitosa
            return $this->sendResponse($evento->toArray(), 'Evento actualizado con éxito.');
        } catch (\Throwable $e) {
            // Si algo falla, deshacer cualquier cambio en la base de datos
            DB::rollBack();

            // Retornar un error con el mensaje de excepción (opcionalmente, podrías omitir el mensaje en producción)
            return $this->sendError('Error al actualizar el evento.'.$e->getMessage(), 500);
        }
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
