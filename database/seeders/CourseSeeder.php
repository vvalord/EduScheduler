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

        $dam1 = Curso::create([
            'nombre' => 'Desarrollo de Aplicaciones Multiplataforma',
            'cod' => '1ºDAM'
        ]);
        $dam1->asignaturas()->attach([14,15,16,5,17,18]);

        $dam2 = Curso::create([
            'nombre' => 'Desarrollo de Aplicaciones Multiplataforma',
            'cod' => '2ºDAM'
        ]);
        $dam2->asignaturas()->attach([19,20,21,22,23,12,24]);

        $smr1 = Curso::create([
            'nombre' => 'Sistemas Microinformáticos y Redes',
            'cod' => '1ºSMR'
        ]);
        $smr1->asignaturas()->attach([25,26,27,28,29]);

        $smr2 = Curso::create([
            'nombre' => 'Sistemas Microinformáticos y Redes',
            'cod' => '2ºSMR'
        ]);
        $smr2->asignaturas()->attach([30,31,32,33,12,34]);

    }
}
