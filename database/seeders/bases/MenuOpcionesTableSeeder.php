<?php

namespace Database\Seeders\bases;

use App\Models\MenuOpcion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuOpcionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class="Database\Seeders\bases\MenuOpcionesTableSeeder"
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        MenuOpcion::truncate();

        MenuOpcion::create([
            "id" => 1,
            "titulo" => "Inicio",
            "icono" => "ri-home-8-line",
            "ruta" => "index",
            "orden" => 0,
            "action" => "Listar Inicio",
            "subject" => "Inicio",
            "parent_id" => null
        ]);

        MenuOpcion::create([
            "id" => 2,
            "titulo" => null,
            "icono" => null,
            "ruta" => null,
            "orden" => 1,
            "titulo_seccion" => "Administración",
            "action" => "Ver Modulo Usuarios",
            "subject" => "User",
            "parent_id" => null
        ]);

        MenuOpcion::create([
            "id" => 3,
            "titulo" => "Modulo Usuarios",
            "icono" => "ri-group-line",
            "ruta" => null,
            "orden" => 2,
            "action" => "Ver Modulo Usuarios",
            "subject" => "User",
            "parent_id" => null
        ]);

// Submenús del Modulo Usuarios
        MenuOpcion::create([
            "id" => 4,
            "titulo" => "Usuarios",
            "icono" => "ri-list-ordered-2",
            "ruta" => "admin-modulo-usuarios-usuarios",
            "orden" => 3,
            "action" => "Listar Usuarios",
            "subject" => "User",
            "parent_id" => 3
        ]);

        MenuOpcion::create([
            "id" => 5,
            "titulo" => "Roles",
            "icono" => "ri-folder-shield-2-line",
            "ruta" => "admin-modulo-usuarios-roles",
            "orden" => 4,
            "action" => "Listar Roles",
            "subject" => "Rol",
            "parent_id" => 3
        ]);

        MenuOpcion::create([
            "id" => 6,
            "titulo" => "Permisos",
            "icono" => "ri-file-shield-2-fill",
            "ruta" => "admin-modulo-usuarios-permisos",
            "orden" => 5,
            "action" => "Listar Permisos",
            "subject" => "Permission",
            "parent_id" => 3
        ]);

        MenuOpcion::create([
            "id" => 7,
            "titulo" => "Estados de usuarios",
            "icono" => "ri-folder-user-fill",
            "ruta" => "admin-modulo-usuarios-usuario-estados",
            "orden" => 6,
            "action" => "Listar Usuario Estados",
            "subject" => "UserEstado",
            "parent_id" => 3
        ]);

        MenuOpcion::create([
            "id" => 8,
            "titulo" => "Configuraciones",
            "icono" => "ri-folder-settings-fill",
            "ruta" => null,
            "orden" => 7,
            "action" => "Ver Modulo Configuracion",
            "subject" => "Configuracion",
            "parent_id" => null
        ]);

        MenuOpcion::create([
            "id" => 9,
            "titulo" => "Opciones Menu",
            "icono" => "ri-apps-2-add-line",
            "ruta" => "admin-configuraciones-menu",
            "orden" => 8,
            "action" => "Listar Menu Opciones",
            "subject" => "Menu Opcion",
            "parent_id" => 8
        ]);

        MenuOpcion::create([
            "id" => 10,
            "titulo" => "Generales",
            "icono" => "ri-settings-3-fill",
            "ruta" => "admin-configuraciones-generales",
            "orden" => 9,
            "action" => "Listar Configuraciones Generales",
            "subject" => "Configuracion",
            "parent_id" => 8
        ]);

        MenuOpcion::create([
            "id" => 11,
            "titulo" => null,
            "icono" => null,
            "ruta" => null,
            "orden" => 10,
            "titulo_seccion" => "Modulo Programación",
            "action" => "Ver Modulo Desarrollo",
            "subject" => "Desarrollo",
            "parent_id" => null
        ]);

        MenuOpcion::create([
            "id" => 12,
            "titulo" => "Developers",
            "icono" => "ri-tools-fill",
            "ruta" => "second-page",
            "orden" => 11,
            "action" => "Ver Modulo Desarrollo",
            "subject" => "Desarrollo",
            "parent_id" => null
        ]);

        MenuOpcion::create([
            "id" => 13,
            "titulo" => "Configuraciones",
            "icono" => "ri-settings-5-fill",
            "ruta" => "dev-configuraciones",
            "orden" => 12,
            "action" => "Listar Configuraciones",
            "subject" => "Configuracion",
            "parent_id" => 12
        ]);

        MenuOpcion::create([
            "id" => 14,
            "titulo" => "Componentes",
            "icono" => "ri-code-box-line",
            "ruta" => "dev-componentes",
            "orden" => 13,
            "action" => "Listar Componentes",
            "subject" => "Desarrollo",
            "parent_id" => 12
        ]);

        MenuOpcion::create([
            "id" => 15,
            "titulo" => null,
            "icono" => null,
            "ruta" => null,
            "orden" => 14,
            "titulo_seccion" => "Iglesia",
            "action" => "", //pendiente
            "subject" => "User", //pendiente
            "parent_id" => null
        ]);

        MenuOpcion::create([
            "id" => 16,
            "titulo" => "Miembros",
            "icono" => "ri-code-box-line",
            "ruta" => null,
            "orden" => 15,
            "action" => "Modulo Personas",
            "subject" => "Persona",
            "parent_id" => null
        ]);

        MenuOpcion::create([
            "id" => 17,
            "titulo" => "Listar Miembros",
            "icono" => "ri-code-box-line",
            "ruta" => "personas",
            "orden" => 16,
            "action" => "Listar Personas",
            "subject" => "Persona",
            "parent_id" => 16
        ]);

        MenuOpcion::create([
            "id" => 18,
            "titulo" => "Catálogos",
            "icono" => "ri-code-box-line",
            "ruta" => null,
            "orden" => 17,
            "action" => "Listar Catálogos Personas",
            "subject" => "Persona",
            "parent_id" => 16
        ]);

        MenuOpcion::create([
            "id" => 19,
            "titulo" => "Géneros",
            "icono" => "ri-code-box-line",
            "ruta" => 'personas-catalogos-generos',
            "orden" => 18,
            "action" => "Listar Persona Generos",
            "subject" => "PersonaGenero",
            "parent_id" => 18
        ]);

        MenuOpcion::create([
            "id" => 20,
            "titulo" => "Estados",
            "icono" => "ri-code-box-line",
            "ruta" => 'personas-catalogos-estados',
            "orden" => 19,
            "action" => "Listar Persona Estados",
            "subject" => "PersonaGenero",
            "parent_id" => 18
        ]);

        MenuOpcion::create([
            "id" => 21,
            "titulo" => "Niveles Académicos",
            "icono" => "ri-code-box-line",
            "ruta" => 'personas-catalogos-nivel-academico',
            "orden" => 20,
            "action" => "Listar Persona Nivel Academicos",
            "subject" => "PersonaNivelAcademico",
            "parent_id" => 18
        ]);

        MenuOpcion::create([
            "id" => 22,
            "titulo" => "Eventos",
            "icono" => "ri-code-box-line",
            "ruta" => null,
            "orden" => 21,
            "action" => "Modulo Eventos",
            "subject" => "Evento",
            "parent_id" => null
        ]);

        MenuOpcion::create([
            "id" => 23,
            "titulo" => "Bautizos",
            "icono" => "ri-code-box-line",
            "ruta" => null,
            "orden" => 22,
            "action" => "Listar Bautizos",
            "subject" => "Bautizo",
            "parent_id" => 22
        ]);
        MenuOpcion::create([
            "id" => 24,
            "titulo" => "Actividades",
            "icono" => "ri-code-box-line",
            "ruta" => null,
            "orden" => 23,
            "action" => "Listar Eventos",
            "subject" => "Evento",
            "parent_id" => 22
        ]);

        MenuOpcion::create([
            "id" => 25,
            "titulo" => "Catálogos",
            "icono" => "ri-code-box-line",
            "ruta" => 'eventos-catalogos-tipos',
            "orden" => 24,
            "action" => "Modulo Catalogos Eventos", //Pendiente
            "subject" => "Evento",
            "parent_id" => 22
        ]);
        MenuOpcion::create([
            "id" => 26,
            "titulo" => "Tipos de Eventos",
            "icono" => "ri-code-box-line",
            "ruta" => 'eventos-catalogos-tipos',
            "orden" => 25,
            "action" => "Listar Evento Tipos",
            "subject" => "EventoTipo",
            "parent_id" => 25
        ]);

        MenuOpcion::create([
            "id" => 27,
            "titulo" => "Congregación",
            "icono" => "ri-code-box-line",
            "ruta" => null,
            "orden" => 26,
            "action" => "Modulo Congregación",
            "subject" => "Ministerio",
            "parent_id" => null
        ]);

        MenuOpcion::create([
            "id" => 28,
            "titulo" => "Iglesias",
            "icono" => "ri-code-box-line",
            "ruta" => 'iglesias-catalogos-iglesias',
            "orden" => 27,
            "action" => "Listar Iglesias",
            "subject" => "Iglesia",
            "parent_id" => 27
        ]);

        MenuOpcion::create([
            "id" => 29,
            "titulo" => "Ministerios",
            "icono" => "ri-code-box-line",
            "ruta" => 'ministerios',
            "orden" => 28,
            "action" => "Listar Ministerios",
            "subject" => "Ministerio",
            "parent_id" => 27
        ]);

        MenuOpcion::create([
            "id" => 30,
            "titulo" => "Familias",
            "icono" => "ri-code-box-line",
            "ruta" => 'personas-catalogos-familias',
            "orden" => 29,
            "action" => "Listar Familias",
            "subject" => "Familia",
            "parent_id" => 27
        ]);

        MenuOpcion::create([
            "id" => 31,
            "titulo" => "Catálogos",
            "icono" => "ri-code-box-line",
            "ruta" => null,
            "orden" => 30,
            "action" => "Modulo Catalogos Congregacion",
            "subject" => "Ministerio",
            "parent_id" => 27
        ]);
        MenuOpcion::create([
            "id" => 32,
            "titulo" => "Grados de Parentesco",
            "icono" => "ri-code-box-line",
            "ruta" => 'personas-catalogos-familia-tipos',
            "orden" => 31,
            "action" => "Listar Familia Tipos",
            "subject" => "FamiliaTipo",
            "parent_id" => 31
        ]);


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
