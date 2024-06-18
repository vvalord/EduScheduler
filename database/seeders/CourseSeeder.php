<?php

namespace Database\Seeders;

use App\Models\Asignatura;
use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asir1 = Curso::create([
            'nombre' => 'Administración de Sistemas Informáticos en Red',
            'cod' => '1ºASIR'
        ]);
        $asir1->asignaturas()->attach([1,2,3,4,5,6]);

        $asir2 = Curso::create([
            'nombre' => 'Administración de Sistemas Informáticos en Red',
            'cod' => '2ºASIR'
        ]);
        $asir2->asignaturas()->attach([7,8,9,10,11,12,13]);

    }
}
