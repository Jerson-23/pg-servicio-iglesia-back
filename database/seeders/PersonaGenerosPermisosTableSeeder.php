<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Persona\PersonaNivelAcademico;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class PersonaGenerosPermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'Listar Persona Generos',
            'Ver Persona Generos',
            'Crear Persona Generos',
            'Editar Persona Generos',
            'Eliminar Persona Generos',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'subject' => 'PersonaGenero',
                'guard_name' => Rol::GUARD_NAME_ACTUAL,
            ]);
        }

        $rolAdmin = Rol::findById(Rol::ADMINISTRADOR);

        $rolAdmin->givePermissionTo($permisos);
    }
}
