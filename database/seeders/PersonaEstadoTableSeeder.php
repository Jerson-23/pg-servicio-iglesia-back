<?php

namespace Database\Seeders;

use App\Models\Persona\PersonaEstado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaEstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        PersonaEstado::truncate();

        PersonaEstado::create([
            'nombre' => 'Activo',
        ]);
        PersonaEstado::create([
            'nombre' => 'Inactivo',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
