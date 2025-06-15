<?php

namespace Database\Seeders;

use App\Models\Persona\PersonaNivelAcademico;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaNivelAcademicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        PersonaNivelAcademico::truncate();

        PersonaNivelAcademico::create([
            'nombre' => 'Primaria',
        ]);
        PersonaNivelAcademico::create([
            'nombre' => 'Secundaria',
        ]);
        PersonaNivelAcademico::create([
            'nombre' => 'Preparatoria',
        ]);
        PersonaNivelAcademico::create([
            'nombre' => 'Licenciatura',
        ]);
        PersonaNivelAcademico::create([
            'nombre' => 'Maestría',
        ]);
        PersonaNivelAcademico::create([
            'nombre' => 'Doctorado',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
