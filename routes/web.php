<?php

use App\Models\Profesor;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
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
