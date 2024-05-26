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

//Update form
//Aqui hago el inertia aqui y no en el controller, porque uso el controller en otras funciones
Route::get('/cargo/{id}',function(){
    return Inertia::render('CargosForm',[
        //Obtener los dato del cargo para introudcirlo en el input
        'cargo'=>CargoController::searchById($id)
    ]);
});

//Update form sent data
Route::put('/cargo/{id}',[CargoController::class,'update']);

//Delete Cargo
Route::delete('/cargo/{id}',[CargoController::class,'delete']);