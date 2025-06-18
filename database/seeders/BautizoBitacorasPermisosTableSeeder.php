<?php

namespace Database\Seeders;

use App\Models\Evento\BautizoBitacora;
use App\Models\Permission;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class BautizoBitacorasPermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'Listar Bautizo Bitacoras',
            'Ver Bautizo Bitacoras',
            'Crear Bautizo Bitacoras',
            'Editar Bautizo Bitacoras',
            'Eliminar Bautizo Bitacoras',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'subject' => 'BautizoBitacora',
                'guard_name' => Rol::GUARD_NAME_ACTUAL,
            ]);
        }

        $rolAdmin = Rol::findById(Rol::ADMINISTRADOR);

        $rolAdmin->givePermissionTo($permisos);
    }
}
