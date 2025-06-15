<?php

namespace Database\Seeders;

use Database\Seeders\bases\IndexTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(IndexTableSeeder::class);

        //Catálogos
        $this->call([
            MinisterioTableSeeder::class,
            PersonaEstadoTableSeeder::class,
            PersonaNivelAcademicoTableSeeder::class,
            PersonaGeneroTableSeeder::class,
            EventoTipoTableSeeder::class,
            FamiliaTipoTableSeeder::class,
        ]);

        //Permisos
        $this->call([
            MinisteriosPermisosTableSeeder::class,
            PersonaEstadosPermisosTableSeeder::class,
            PersonaNivelAcademicoPermisosTableSeeder::class,
            PersonaGenerosPermisosTableSeeder::class,
            EventoTiposPermisosTableSeeder::class,
            FamiliasTiposPermisosTableSeeder::class,
        ]);

    }
}
