<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class FamiliasTiposPermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'Listar Familia Tipos',
            'Ver Familia Tipos',
            'Crear Familia Tipos',
            'Editar Familia Tipos',
            'Eliminar Familia Tipos',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'subject' => 'FamiliaTipo',
                'guard_name' => Rol::GUARD_NAME_ACTUAL,
            ]);
        }

        $rolAdmin = Rol::findById(Rol::ADMINISTRADOR);

        $rolAdmin->givePermissionTo($permisos);
    }
}
