<?php

namespace Database\Seeders;

use App\Models\Ministerio\Ministerio;
use App\Models\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Rol::firstOrCreate(
            ['name' => 'Pastor'],
            [
                'guard_name' => 'web',
            ]
        );

        Rol::firstOrCreate(
            ['name' => 'Co Pastor'],
            [
                'guard_name' => 'web',
            ]
        );


    }
}
