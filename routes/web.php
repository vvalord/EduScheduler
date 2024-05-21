<?php

use App\Models\Profesor;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {

    $profesores = Profesor::with(['asignaturasCursos.curso', 'asignaturasCursos.asignatura'])->get();
    $ret = "";
    foreach ($profesores as $profesor) {
        $ret.= "---Profesor: " . $profesor->nombre . "\n";
        $cursos = [];
        foreach ($profesor->asignaturasCursos as $relation) {
            $cursoNombre = $relation->curso->cod;
            if (!isset($cursos[$cursoNombre])) {
                $cursos[$cursoNombre] = [];
            }
            $cursos[$cursoNombre][] = $relation->asignatura->cod;
        }
        foreach ($cursos as $cursoNombre => $asignaturas) {
            $ret.= "  Curso: " . $cursoNombre . ":\n";
            foreach ($asignaturas as $asignaturaNombre) {
                $ret.= $asignaturaNombre . "\n";
            }
        }
    }
    //dd($ret);
    return Inertia::render('Home', [
        'profesores' => [''],
        'test' => $ret
    ]);
});

Route::get('/profesores', function () {
    $ret = Profesor::all();
    //dd($ret);
    return Inertia::render('Profesores', [
        'profesores' => $ret
    ]);
});

Route::get('/asignaturas', function () {
    return Inertia::render('Asignaturas');
});

Route::get('/cursos', function () {
    return Inertia::render('Cursos');
});

Route::get('/cargos', function () {
    return Inertia::render('Cargos');
});
