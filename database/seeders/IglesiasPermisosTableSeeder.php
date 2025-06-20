<?php

namespace Database\Seeders;

use App\Models\Evento\BautizoBitacora;
use App\Models\Iglesia\Iglesia;
use App\Models\Permission;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class IglesiasPermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'Listar Iglesias',
            'Ver Iglesias',
            'Crear Iglesias',
            'Editar Iglesias',
            'Eliminar Iglesias',
            'Modulo Iglesias',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'subject' => 'Iglesia',
                'guard_name' => Rol::GUARD_NAME_ACTUAL,
            ]);
        }

        $rolAdmin = Rol::findById(Rol::ADMINISTRADOR);

        $rolAdmin->givePermissionTo($permisos);
    }
}
