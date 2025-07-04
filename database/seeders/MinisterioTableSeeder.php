<?php

namespace Database\Seeders;

use App\Models\Ministerio\Ministerio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinisterioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Ministerio::truncate();

        Ministerio::create([
            'nombre' => 'Musical',
        ]);
        Ministerio::create([
            'nombre' => 'Limpieza',
        ]);
        Ministerio::create([
            'nombre' => 'Logistica',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
