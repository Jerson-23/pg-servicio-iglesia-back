<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Persona\PersonaNivelAcademico;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class PersonaNivelAcademicoPermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            'Listar Persona Nivel Academicos',
            'Ver Persona Nivel Academicos',
            'Crear Persona Nivel Academicos',
            'Editar Persona Nivel Academicos',
            'Eliminar Persona Nivel Academicos',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'subject' => 'PersonaNivelAcademico',
                'guard_name' => Rol::GUARD_NAME_ACTUAL,
            ]);
        }

        $rolAdmin = Rol::findById(Rol::ADMINISTRADOR);

        $rolAdmin->givePermissionTo($permisos);
    }
}
