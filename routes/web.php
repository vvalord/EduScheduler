<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/profesores', function () {
    return Inertia::render('Profesores');
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
