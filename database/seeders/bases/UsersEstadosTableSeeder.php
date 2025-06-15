<?php

namespace Database\Seeders\bases;

use App\Models\UserEstado;
use Illuminate\Database\Seeder;

class UsersEstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserEstado::firstOrCreate([
            'nombre' => 'Activo',
        ]);
        UserEstado::firstOrCreate([
            'nombre' => 'Inactivo',
        ]);
        UserEstado::firstOrCreate([
            'nombre' => 'Bloqueado',
        ]);

    }
}
