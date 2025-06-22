<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class EventosPermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'Listar Eventos',
            'Ver Eventos',
            'Crear Eventos',
            'Editar Eventos',
            'Eliminar Eventos',
            'Tomar Asistencia Eventos',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'subject' => 'Evento',
                'guard_name' => Rol::GUARD_NAME_ACTUAL,
            ]);
        }

        $rolAdmin = Rol::findById(Rol::ADMINISTRADOR);

        $rolAdmin->givePermissionTo($permisos);
    }
}
