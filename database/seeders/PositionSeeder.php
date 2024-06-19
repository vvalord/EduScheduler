<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cargo::create([
            'nombre' => 'Jefatura de Estudios'
        ]);

        Cargo::create([
            'nombre' => 'Jefatura Departamento Informática y Com.'
        ]);

        Cargo::create([
            'nombre' => 'Coordinador TDE'
        ]);

        Cargo::create([
            'nombre' => 'Jefatura de Estudios Adjunta'
        ]);
    }
}
