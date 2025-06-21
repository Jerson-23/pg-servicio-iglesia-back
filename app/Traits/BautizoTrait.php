<?php

namespace App\Traits;

use App\Models\Congregacion\Bautizo;
use App\Models\Persona\Persona;
use Illuminate\Support\Facades\Auth;

trait BautizoTrait
{
    /**
     * Guarda un registro en la bitácora de una persona.
     *
     * @param Persona $persona La persona a la que se asociará la bitácora.
     * @param string $titulo Título del evento o actividad.
     * @param string|null $descripcion Descripción opcional del evento o actividad.
     * @return void
     */
    public function guardarEnBitacora(Bautizo $bautizo, $titulo, $descripcion = null)
    {
        try {
            // Crea un nuevo registro en la bitácora asociada a la persona
            $bautizo->bitacoras()->create([
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'user_registra_id' => Auth::user()->id, // ID del usuario autenticado que registra
                'fecha_registro' => now(), // Fecha y hora actual del registro
            ]);
        } catch (\Exception $e) {
            // Manejo de errores: puedes loguear el error o lanzar una excepción personalizada
            \Log::error('Error al guardar en bitácora: ' . $e->getMessage());

            // Opcionalmente, podrías relanzar la excepción si quieres que se propague
            throw $e;
        }
    }
}
