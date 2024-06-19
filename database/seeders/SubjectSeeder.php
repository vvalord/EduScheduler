<?php

namespace Database\Seeders;

use App\Models\Asignatura;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //-----------------
        //     1ºASIR
        //-----------------
        Asignatura::create([
            'nombre' => 'Implantación de Sistemas Operativos',
            'cod' => 'ISO',
            'horas' => 8
        ]);

        Asignatura::create([
            'nombre' => 'Planificación y Administración de Redes',
            'cod' => 'PAR',
            'horas' => 6
        ]);

        Asignatura::create([
            'nombre' => 'Fundamentos de Hardware',
            'cod' => 'FH',
            'horas' => 3
        ]);

        Asignatura::create([
            'nombre' => 'Gestión de Base de Datos',
            'cod' => 'GBD',
            'horas' => 6
        ]);

        Asignatura::create([
            'nombre' => 'Lenguajes de Marca y Sistemas de Gestión de Información',
            'cod' => 'LMSGI',
            'horas' => 4
        ]);

        Asignatura::create([
            'nombre' => 'Tutoría 1º ASIR',
            'cod' => 'TUT1ASIR',
            'horas' => 0
        ]);

        //-----------------
        //     2ºASIR
        //-----------------
        Asignatura::create([
            'nombre' => 'Administración de Sistemas Operativos',
            'cod' => 'ASO',
            'horas' => 6
        ]);

        Asignatura::create([
            'nombre' => 'Servicios de red e internet',
            'cod' => 'SRI',
            'horas' => 6
        ]);

        Asignatura::create([
            'nombre' => 'Implantación de Aplicaciones Web',
            'cod' => 'IAW',
            'horas' => 4
        ]);

        Asignatura::create([
            'nombre' => 'Administración de Sistemas Gestores de BD',
            'cod' => 'ASGB',
            'horas' => 3
        ]);

        Asignatura::create([
            'nombre' => 'Seguridad y Alta Disponibilidad',
            'cod' => 'SAD',
            'horas' => 4
        ]);

        Asignatura::create([
            'nombre' => 'Horas de Libre configuración',
            'cod' => 'HLC',
            'horas' => 3
        ]);

        Asignatura::create([
            'nombre' => 'Tutoría 2º ASIR',
            'cod' => 'TUT2ASIR',
            'horas' => 0
        ]);

        //-----------------
        //     1ºDAM
        //-----------------
        Asignatura::create([
            'nombre' => 'Sistemas informáticos',
            'cod' => 'SI',
            'horas' => 6
        ]);

        Asignatura::create([
            'nombre' => 'Base de datos',
            'cod' => 'BD',
            'horas' => 6
        ]);

        Asignatura::create([
            'nombre' => 'Programación',
            'cod' => 'PROG',
            'horas' => 8
        ]);

        /*Asignatura::create([
            'nombre' => 'Lenguajes de marcas y sistemas de gestión de información',
            'cod' => 'LMSGI',
            'horas' => 4
        ]);*/

        Asignatura::create([
            'nombre' => 'Entornos de desarrollo',
            'cod' => 'ED',
            'horas' => 3
        ]);

        Asignatura::create([
            'nombre' => 'Tutoría 1º DAM',
            'cod' => 'TUT1DAM',
            'horas' => 0
        ]);

        //-----------------
        //     2ºDAM
        //-----------------
        Asignatura::create([
            'nombre' => 'Acceso a Datos',
            'cod' => 'AD',
            'horas' => 5
        ]);

        Asignatura::create([
            'nombre' => 'Desarrollo de Interfaces',
            'cod' => 'DI',
            'horas' => 7
        ]);

        Asignatura::create([
            'nombre' => 'Programación multimedia y dispositivos móviles',
            'cod' => 'PMDM',
            'horas' => 4
        ]);

        Asignatura::create([
            'nombre' => 'Programación de servicios y procesos',
            'cod' => 'PSP',
            'horas' => 3
        ]);

        Asignatura::create([
            'nombre' => 'Sistemas de gestión empresarial',
            'cod' => 'SGE',
            'horas' => 4
        ]);

        /*Asignatura::create([
            'nombre' => 'Horas de Libre configuración',
            'cod' => 'HLC',
            'horas' => 3
        ]);*/

        Asignatura::create([
            'nombre' => 'Tutoría 2º DAM',
            'cod' => 'TUT2DAM',
            'horas' => 0
        ]);

        //-----------------
        //     1ºSMR
        //-----------------
        Asignatura::create([
            'nombre' => 'Montaje y mantenimiento de equipos',
            'cod' => 'MME',
            'horas' => 7
        ]);

        Asignatura::create([
            'nombre' => 'Sistemas operativos monopuesto',
            'cod' => 'SOM',
            'horas' => 5
        ]);

        Asignatura::create([
            'nombre' => 'Aplicaciones ofimáticas',
            'cod' => 'AOM',
            'horas' => 8
        ]);

        Asignatura::create([
            'nombre' => 'Redes Locales',
            'cod' => 'RL',
            'horas' => 7
        ]);

        Asignatura::create([
            'nombre' => 'Tutoría 1º SMR',
            'cod' => 'TUT1SMR',
            'horas' => 0
        ]);

        //-----------------
        //     2ºSMR
        //-----------------
        Asignatura::create([
            'nombre' => 'Sistemas Operativos en red',
            'cod' => 'SOR',
            'horas' => 7
        ]);

        Asignatura::create([
            'nombre' => 'Servicios en red',
            'cod' => 'SR',
            'horas' => 7
        ]);

        Asignatura::create([
            'nombre' => 'Seguridad informática',
            'cod' => 'SI',
            'horas' => 5
        ]);

        Asignatura::create([
            'nombre' => 'Aplicaciones web',
            'cod' => 'AW',
            'horas' => 4
        ]);

        /*Asignatura::create([
            'nombre' => 'Horas de Libre configuración',
            'cod' => 'HLC',
            'horas' => 4
        ]);*/

        Asignatura::create([
            'nombre' => 'Tutoría 2º SMR',
            'cod' => 'TUT2SMR',
            'horas' => 0
        ]);

    }
}
