<?php

use App\Http\Controllers\CargoController;
use Illuminate\Http\Request;
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