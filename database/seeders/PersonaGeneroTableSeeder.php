<?php

namespace Database\Seeders;

use App\Models\Persona\PersonaGenero;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaGeneroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        PersonaGenero::truncate();

        PersonaGenero::create([
            'nombre' => 'Masculino',
        ]);
        PersonaGenero::create([
            'nombre' => 'Femenino',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
