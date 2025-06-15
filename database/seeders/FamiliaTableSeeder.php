<?php

namespace Database\Seeders;

use App\Models\Persona\Familia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamiliaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Familia::truncate();

        Familia::create([
            'nombre' => 'Familia Pérez',
            'descripcion' => 'Familia de ejemplo 1',
        ]);

        Familia::create([
            'nombre' => 'Familia Gómez',
            'descripcion' => 'Familia de ejemplo 2',
        ]);

        Familia::create([
            'nombre' => 'Familia Rodríguez',
            'descripcion' => 'Familia de ejemplo 3',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
