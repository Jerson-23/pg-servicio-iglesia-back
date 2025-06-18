<?php

namespace App\Http\Controllers\Api\Persona;

use App\Http\Controllers\AppBaseController;
use App\Traits\PersonaTrait;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\Api\Persona\CreatePersonaApiRequest;
use App\Http\Requests\Api\Persona\UpdatePersonaApiRequest;
use App\Models\Persona\Persona;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class PersonaApiController
 */
class PersonaApiController extends AppbaseController implements HasMiddleware
{

    use PersonaTrait;

    /**
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Personas', only: ['index']),
            new Middleware('permission:Ver Personas', only: ['show']),
            new Middleware('permission:Crear Personas', only: ['store']),
            new Middleware('permission:Editar Personas', only: ['update']),
            new Middleware('permission:Eliminar Personas', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the Personas.
     * GET|HEAD /personas
     */
    public function index(Request $request): JsonResponse
    {
        $personas = QueryBuilder::for(Persona::class)
            ->allowedFilters([
                AllowedFilter::callback('nombre', function ($query, $value) {
                    $query->where(function ($q) use ($value) {
                        $q->where('primer_nombre', 'LIKE', "%{$value}%")
                            ->orWhere('segundo_nombre', 'LIKE', "%{$value}%")
                            ->orWhere('primer_apellido', 'LIKE', "%{$value}%")
                            ->orWhere('segundo_apellido', 'LIKE', "%{$value}%");
                    });
                }),
                'primer_nombre',
                'segundo_nombre',
                'primer_apellido',
                'segundo_apellido',
                'telefono',
                'direccion',
                'email',
                'ministerio_id',
                'estado_id',
                'fecha_nacimiento',
                'correlativo',
                'dpi',
                'nivel_academico_id',
                'genero_id'
            ])
            ->allowedSorts([
                'primer_nombre',
                'segundo_nombre',
                'primer_apellido',
                'segundo_apellido',
                'telefono',
                'direccion',
                'email',
                'ministerio_id',
                'estado_id',
                'fecha_nacimiento',
                'correlativo',
                'dpi',
                'nivel_academico_id',
                'genero_id'
            ])
            ->allowedIncludes([
                'ministerio',
                'estado',
                'nivelAcademico',
                'genero'
            ])
            ->defaultSort('-id') // Ordenar por defecto por fecha descendente
            ->paginate($request->get('per_page', 10));

        return $this->sendResponse($personas->toArray(), 'personas recuperados con éxito.');
    }

    /**
     * Store a newly created Persona in storage.
     * POST /personas
     */
    public function store(CreatePersonaApiRequest $request): JsonResponse
    {
        // Inicia una transacción para asegurar que todo se ejecute correctamente
        DB::beginTransaction();

        try {
            // Obtiene todos los datos validados del request
            $input = $request->all();

            // Genera un correlativo basado en el año actual y la cantidad de personas registradas en ese año
            $year = now()->year;
            $count = Persona::whereYear('created_at', $year)->count() + 1;
            $input['correlativo'] = sprintf('%s-%04d', $year, $count);

            // Crea una nueva persona con los datos del request
            $persona = Persona::create($input);

            // Registra la creación en la bitácora de la persona
            $this->guardarEnBitacora(
                $persona,
                'Creación del miembro',
                'Se ha creado el miembro con el correlativo: '.$persona->correlativo
            );

            // Confirma la transacción si todo ha salido bien
            DB::commit();

            // Retorna una respuesta exitosa con los datos de la persona creada
            return $this->sendResponse($persona->toArray(), 'Persona creada con éxito.');

        } catch (\Exception $e) {
            // Revierte la transacción si ocurre un error
            DB::rollBack();

            // Registra el error para su análisis
            \Log::error('Error al crear persona: '.$e->getMessage());

            // Retorna una respuesta de error al cliente
            return $this->sendError('Ocurrió un error al crear la persona.', 500);
        }
    }

    /**
     * Display the specified Persona.
     * GET|HEAD /personas/{id}
     */
    public function show(Persona $persona)
    {
        return $this->sendResponse($persona->toArray(), 'Persona recuperado con éxito.');
    }


    public function update(UpdatePersonaApiRequest $request, $id): JsonResponse
    {
        // Inicia una transacción para asegurar que el proceso sea atómico
        DB::beginTransaction();

        try {
            // Busca la persona por ID, lanza excepción si no se encuentra
            $persona = Persona::findOrFail($id);

            // Actualiza la persona con los datos validados del request
            $persona->update($request->validated());

            // Registra la actualización en la bitácora
            $this->guardarEnBitacora(
                $persona,
                'Actualización del miembro',
                'Se han actualizado los datos del miembro con el correlativo: ' . $persona->correlativo
            );

            // Confirma los cambios en la base de datos
            DB::commit();

            // Devuelve respuesta exitosa con los datos actualizados
            return $this->sendResponse($persona, 'Persona actualizada con éxito.');

        } catch (\Exception $e) {
            // Revierte los cambios si algo falla
            DB::rollBack();

            // Registra el error en el log
            \Log::error('Error al actualizar persona: ' . $e->getMessage());

            // Retorna una respuesta de error
            return $this->sendError('Ocurrió un error al actualizar la persona.', 500);
        }
    }


    public function destroy(Persona $persona): JsonResponse
    {
        // Inicia una transacción para asegurar consistencia
        DB::beginTransaction();

        try {
            // Registra en la bitácora antes de eliminar, para conservar la referencia
            $this->guardarEnBitacora(
                $persona,
                'Eliminación del miembro',
                'Se ha eliminado el miembro con el correlativo: ' . $persona->correlativo
            );

            // Elimina la persona de la base de datos
            $persona->delete();

            // Confirma la transacción
            DB::commit();

            // Retorna respuesta exitosa
            return $this->sendResponse(null, 'Persona eliminada con éxito.');

        } catch (\Exception $e) {
            // Revierte cualquier cambio si ocurre un error
            DB::rollBack();

            // Registra el error en los logs
            \Log::error('Error al eliminar persona: ' . $e->getMessage());

            // Retorna respuesta de error
            return $this->sendError('Ocurrió un error al eliminar la persona.', 500);
        }
    }

}
