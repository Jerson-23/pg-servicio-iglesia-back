<?php

namespace Database\Seeders;

use App\Models\Ministerio\Ministerio;
use App\Models\Nacionalidad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NacionalidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Ministerio::truncate();

        $nacionalidades = [
            'Alemana', 'Argentina', 'Australiana', 'Belga', 'Boliviana',
            'Brasileña', 'Canadiense', 'Chilena', 'China', 'Colombiana',
            'Coreana', 'Cubana', 'Danesa', 'Ecuatoriana', 'Egipcia',
            'Española', 'Estadounidense', 'Filipina', 'Finlandesa', 'Francesa',
            'Griega', 'Guatemalteca', 'Hondureña', 'India', 'Inglesa',
            'Irlandesa', 'Italiana', 'Japonesa', 'Marroquí', 'Mexicana',
            'Nicaragüense', 'Noruega', 'Panameña', 'Paraguaya', 'Peruana',
            'Polaca', 'Portuguesa', 'Puertorriqueña', 'Rumana', 'Rusa',
            'Salvadoreña', 'Sueca', 'Suiza', 'Turca', 'Ucraniana',
            'Uruguaya', 'Venezolana', 'Vietnamita'
        ];

        foreach ($nacionalidades as $nombre) {
            Nacionalidad::create([
                'nombre' => $nombre
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
