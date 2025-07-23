<?php

namespace Database\Seeders;

use App\Models\Persona\Profesion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfecionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Profesion::truncate();

        $profesiones = [
            'Maestro/a',
            'Doctor/a',
            'Enfermero/a',
            'Ingeniero/a',
            'Arquitecto/a',
            'Contador/a',
            'Abogado/a',
            'Psicólogo/a',
            'Agricultor/a',
            'Mecánico/a',
            'Electricista',
            'Fontanero/a',
            'Albañil',
            'Panadero/a',
            'Cocinero/a',
            'Vendedor/a',
            'Repartidor/a',
            'Cajero/a',
            'Secretario/a',
            'Policía',
            'Bombero/a',
            'Soldado',
            'Programador/a',
            'Diseñador/a gráfico',
            'Fotógrafo/a',
            'Pastor/a',
            'Misionero/a',
            'Conductor/a',
            'Barbero/a',
            'Estilista',
            'Carpintero/a',
            'Zapatero/a',
            'Costurero/a',
            'Veterinario/a'
        ];

        foreach ($profesiones as $nombre) {
            Profesion::firstOrCreate([
                'nombre' => $nombre
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
