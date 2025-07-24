<?php

namespace App\Http\Controllers\Api\Congregacion;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Congregacion\CreateBautizoApiRequest;
use App\Models\Congregacion\Bautizo;
use App\Traits\BautizoTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class BautizoApiController
 */
class BautizoApiController extends AppbaseController implements HasMiddleware
{
    use BautizoTrait;

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
            ->allowedFilters([
                'observaciones',
                'fecha_bautiso',
                'persona_id',
                'user_registra_id',
                'iglesia_id',
                AllowedFilter::callback('nombre', function ($query, $value) {
                    $query->whereHas('persona', function ($q) use ($value) {
                        $q->where(function ($subQuery) use ($value) {
                            $subQuery->where('primer_nombre', 'LIKE', "%{$value}%")
                                ->orWhere('segundo_nombre', 'LIKE', "%{$value}%")
                                ->orWhere('primer_apellido', 'LIKE', "%{$value}%")
                                ->orWhere('segundo_apellido', 'LIKE', "%{$value}%");
                        });
                    });
                }),
            ])
            ->allowedSorts([
                'id',
                'observaciones',
                'fecha_bautiso',
                'persona_id',
                'user_registra_id',
                'iglesia_id'
            ])
            ->allowedIncludes([
                'persona',
                'userRegistra',
                'iglesia'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 250));

        return $this->sendResponse($bautisos->toArray(), 'bautisos recuperados con éxito.');
    }

    /**
     * Store a newly created Bautizo in storage.
     * POST /bautisos
     */

    public function store(CreateBautizoApiRequest $request): JsonResponse
    {
        // Obtenemos todos los datos validados del request
        $input = $request->all();

        // Usamos una transacción para asegurar integridad de datos
        DB::beginTransaction();

        try {
            // Crea el registro del bautizo
            $bautizo = Bautizo::create($input);

            $this->guardarEnBitacora($bautizo, 'Bautizo creado', 'Se ha registrado un nuevo bautizo.');

            $this->guardarEnBitacora($bautizo, 'Se agregó un comentario al Bautizo', $input['observaciones'] ?? 'Sin observaciones');
            // Verifica si hay participantes en el input
            if (!empty($input['participantes'])) {
                // Asegura que cada participante sea solo su ID (por si viene como objeto)
                $participantes = collect($input['participantes'])->map(function ($participante) {
                    return is_array($participante) ? $participante['id'] : $participante;
                });

                // Sincroniza los participantes con el bautizo (inserta en tabla pivote)
                $bautizo->participantes()->sync($participantes);

                $this->guardarEnBitacora($bautizo, 'Participantes añadidos', 'Se han añadido participantes al bautizo.');

            } else {
                // Si no se envían participantes, aseguramos que la relación esté vacía
                $bautizo->participantes()->detach();
            }

            // Verificamos si se enviaron imágenes
            if ($request->hasFile('imagenes')) {
                // Aseguramos que las imágenes sean un array
                foreach ($request->file('imagenes') as $imagen) {
                    // Guardamos cada imagen en la colección 'imagenes'
                    $bautizo->addMedia($imagen)
                        ->toMediaCollection('imagenes');
                }
            }

            // Si todo salió bien, confirmamos la transacción
            DB::commit();

            // Retornamos una respuesta exitosa
            return $this->sendResponse($bautizo->toArray(), 'Bautizo creado con éxito.');
        } catch (\Throwable $e) {
            // Si algo falla, revertimos la transacción
            DB::rollBack();

            // Retornamos un error con el mensaje
            return $this->sendError('Error al crear el bautizo.', $e->getMessage(), 500);
        }
    }
    /**
     * Display the specified Bautizo.
     * GET|HEAD /bautisos/{id}
     */
    public function show(Bautizo $bautizo)
    {
        $bautizo->load([
            'persona',
            'userRegistra',
            'iglesia',
            'participantes'
        ]);

        return $this->sendResponse($bautizo->toArray(), 'Bautizo recuperado con éxito.');
    }

    /**
     * Update the specified Bautizo in storage.
     * PUT/PATCH /bautisos/{id}
     */

    public function update(Request $request, $id): JsonResponse
    {
        // Buscamos el bautizo, o lanzamos error 404 si no existe
        $bautizo = Bautizo::findOrFail($id);
        // Obtenemos los datos validados del request
        $input = $request->all();

        logger($request->all());
        // Iniciamos una transacción para asegurar consistencia en la actualización
        DB::beginTransaction();

        try {
            // Actualizamos los campos del bautizo
            $bautizo->update($input);

            // Guardamos en bitácora el evento de actualización
            $this->guardarEnBitacora($bautizo, 'Bautizo actualizado', $request->get('observaciones', 'Sin observaciones'));

            // Verificamos si se enviaron participantes
            if (!empty($input['participantes'])) {
                // Aseguramos que solo se tomen los IDs de los participantes
                $participantes = collect($input['participantes'])->map(function ($participante) {
                    return is_array($participante) ? $participante['id'] : $participante;
                });

                //guardamos en bitácora los participantes
                $this->guardarEnBitacora($bautizo, 'Participantes actualizados', 'Se han actualizado los participantes del bautizo.');


                // Sincronizamos la relación (actualiza tabla pivote)
                $bautizo->participantes()->sync($participantes);
            } else {

                //guardamos en bitácora que se eliminaron los participantes
                $this->guardarEnBitacora($bautizo, 'Participantes', 'No se enviaron participantes, se eliminaron los existentes.');
                // Si no se envían participantes, se eliminan los que tenía antes
                $bautizo->participantes()->detach();
            }

            // Verificamos si se enviaron imágenes
            if ($request->hasFile('imagenes')) {
                // Aseguramos que las imágenes sean un array
                foreach ($request->file('imagenes') as $imagen) {
                    // Guardamos cada imagen en la colección 'imagenes'
                    $bautizo->addMedia($imagen)
                        ->toMediaCollection('imagenes');
                }
            }

            // Confirmamos la transacción
            DB::commit();

            // Respondemos con éxito
            return $this->sendResponse($bautizo->toArray(), 'Bautizo actualizado con éxito.');
        } catch (\Throwable $e) {
            // Revertimos la transacción en caso de error
            DB::rollBack();

            // Respondemos con error y mensaje técnico
            return $this->sendError('Error al actualizar el bautizo.'.$e->getMessage());
        }
    }

    /**
     * Remove the specified Bautizo from storage.
     * DELETE /bautisos/{id}
     */
    public function destroy(Bautizo $bautizo): JsonResponse
    {
        try {
            DB::beginTransaction();
            // Eliminamos el bautizo
            $bautizo->participantes()->detach(); // Eliminamos la relación con los participantes
            $bautizo->delete();
            DB::commit();
        }
        catch (\Throwable $e) {
            DB::rollBack();
            return $this->sendError('Error al eliminar el bautizo.', $e->getMessage(), 500);
        }
        return $this->sendResponse([], 'Bautizo eliminado con éxito.');

    }

    public function eliminarImagen(Media $id)
    {
        try {
            $media = Media::findOrFail($id->id);
            $media->delete();
            return $this->sendSuccess('Imagen eliminada con éxito.');
        } catch (\Throwable $e) {
            return $this->sendError('Error al eliminar la imagen.', $e->getMessage(),);
        }
    }
}
