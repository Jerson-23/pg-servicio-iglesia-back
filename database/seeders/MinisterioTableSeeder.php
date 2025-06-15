<?php

namespace Database\Seeders;

use App\Models\Ministerio\Ministerio;
use Illuminate\Database\Seeder;

class MinisterioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ministerio::create([
            'nombre' => 'Musical',
        ]);
        Ministerio::create([
            'nombre' => 'Limpieza',
        ]);
        Ministerio::create([
            'nombre' => 'Logistica',
        ]);
    }
}
