<?php

namespace Database\Seeders;

use App\Models\Evento\EventoTipo;
use App\Models\Persona\Familia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventoTipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        EventoTipo::truncate();

        EventoTipo::create([
            'nombre' => 'Reunión',
        ]);

        EventoTipo::create([
            'nombre' => 'Culto',
        ]);

        EventoTipo::create([
            'nombre' => 'Ensayo',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
