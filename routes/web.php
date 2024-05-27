<?php

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfesorController;
use Illuminate\Http\Request;
use App\Models\Profesor;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});
/*
Route::get('/profesores', function () {
    $ret = Profesor::all();
    //dd($ret);
    return Inertia::render('Profesores', [
        'profesores' => $ret
    ]);
});*/

//Listado profesores
Route::get('/profesores', [ProfesorController::class,'search']);

//Enviar datos from Profesor
Route::post('/profesores',[ProfesorController::class,'insert']);

//Listado asignaturas
Route::get('/asignaturas', [AsignaturaController::class,'search']);

//Enviar datos from Asignatura
Route::post('/asignaturas',[AsignaturaController::class,'insert']);

//Listado cursos
Route::get('/cursos', [CursoController::class,'search']);

//Enviar datos from Curso
Route::post('/cursos',[CursoController::class,'insert']);

//Listado cargos
Route::get('/cargos', [CargoController::class,'search']);

//Enviar datos from Cargo
Route::post('/cargos',[CargoController::class,'insert']);

//Update form sent data
Route::put('/cargos/{id}',[CargoController::class,'update']);

//Delete Cargo
Route::delete('/cargos/{id}',[CargoController::class,'delete']);

Route::delete('/profesores/{id}',[ProfesorController::class,'delete']);
Route::delete('/asignaturas/{id}',[AsignaturaController::class,'delete']);
Route::delete('/cursos/{id}',[CursoController::class,'delete']);

