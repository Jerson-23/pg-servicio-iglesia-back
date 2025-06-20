<?php

namespace Database\Seeders;

use App\Models\Evento\BautizoBitacora;
use App\Models\Permission;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class BautizosPermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'Listar Bautizos',
            'Ver Bautizos',
            'Crear Bautizos',
            'Editar Bautizos',
            'Eliminar Bautizos',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'subject' => 'Bautizo',
                'guard_name' => Rol::GUARD_NAME_ACTUAL,
            ]);
        }

        $rolAdmin = Rol::findById(Rol::ADMINISTRADOR);

        $rolAdmin->givePermissionTo($permisos);
    }
}
