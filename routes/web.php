<?php

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfesorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
/////
// Login
/////
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function () {
/////
// Logout
/////
    Route::post('logout', [LoginController::class, 'logout']);

/////
// HOME | Assign subjects
/////
    Route::get('/', [AssignController::class, 'create']);
    Route::post('/asignarAsignatura', [AssignController::class, 'insert']);
    Route::delete('desasignarAsignatura/{id}', [AssignController::class, 'delete']);

/////
//PROFESORES
/////
//Listado profesores
    Route::get('/profesores', [ProfesorController::class, 'search']);

//Enviar datos from Profesor
    Route::post('/profesores', [ProfesorController::class, 'insert']);

//Update form sent data
    Route::put('/profesores/{id}', [ProfesorController::class, 'update']);

//Delete Profesor
    Route::delete('/profesores/{id}', [ProfesorController::class, 'delete']);

/////
//ASIGNATURAS
/////
//Listado asignaturas
    Route::get('/asignaturas', [AsignaturaController::class, 'search']);

//Enviar datos from Asignatura
    Route::post('/asignaturas', [AsignaturaController::class, 'insert']);

//Update form sent data
    Route::put('/asignaturas/{id}', [AsignaturaController::class, 'update']);

//Delete Asignatura
    Route::delete('/asignaturas/{id}', [AsignaturaController::class, 'delete']);

/////
//CURSOS
/////
//Listado cursos
    Route::get('/cursos', [CursoController::class, 'search']);

//Enviar datos from Curso
    Route::post('/cursos', [CursoController::class, 'insert']);

//Update form sent data
    Route::put('/cursos/{id}', [CursoController::class, 'update']);

//Delete Curso
    Route::delete('/cursos/{id}', [CursoController::class, 'delete']);

/////
//CARGOS
/////
//Listado cargos
    Route::get('/cargos', [CargoController::class, 'search']);
    Route::get('/cargosAll', [CargoController::class, 'searchAll']);
//Enviar datos from Cargo
    Route::post('/cargos', [CargoController::class, 'insert']);

//Update form sent data
    Route::put('/cargos/{id}', [CargoController::class, 'update']);

//Delete Cargo
    Route::delete('/cargos/{id}', [CargoController::class, 'delete']);

});
