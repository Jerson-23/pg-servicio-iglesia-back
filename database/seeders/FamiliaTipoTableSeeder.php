<?php

namespace Database\Seeders;

use App\Models\Persona\Familia;
use App\Models\Persona\FamiliaTipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamiliaTipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        FamiliaTipo::truncate();

        FamiliaTipo::create([
            'nombre' => 'Consanguinidad',
        ]);

        FamiliaTipo::create([
            'nombre' => 'Afinidad',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
