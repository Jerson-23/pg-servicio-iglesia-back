<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Persona\PersonaBitacora;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class PersonaBitacorasPermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'Listar Persona Bitacoras',
            'Ver Persona Bitacoras',
            'Crear Persona Bitacoras',
            'Editar Persona Bitacoras',
            'Eliminar Persona Bitacoras',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'subject' => 'PersonaBitacora',
                'guard_name' => Rol::GUARD_NAME_ACTUAL,
            ]);
        }

        $rolAdmin = Rol::findById(Rol::ADMINISTRADOR);

        $rolAdmin->givePermissionTo($permisos);
    }
}
