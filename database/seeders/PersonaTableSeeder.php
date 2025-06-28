<?php

namespace Database\Seeders;

use App\Models\Persona\Persona;
use Illuminate\Database\Seeder;

class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Persona::factory()->count(50)->create();
    }
}
