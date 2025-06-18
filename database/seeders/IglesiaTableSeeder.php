<?php

namespace Database\Seeders;

use App\Models\Iglesia\Iglesia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IglesiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Iglesia::truncate();

        Iglesia::create([
            'nombre' => 'Iglesia Central',
            'direccion' => 'Calle Principal 123',
            'pastor_id' => 1,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
