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
Route::get('/cargos', function () {
    return Inertia::render('Cargos',[
        'cargos'=>CargoController::search(),
        //Para el input de busqueda
        'filters'=>Request::only(['search'])
    ]);
});
//Enviar datos from Cargo
Route::post('/cargos/create',function(){
    CargoController::insert();
});

//Update form
Route::get('/cargo/{id}',function(){
    return Inertia::render('CargosForm',[
        //Obtener los dato del cargo para introudcirlo en el input
        'cargo'=>CargoController::searchById($id)
    ]);
});

//Update form sent data
Route::put('/cargo/{id}',function(){
    CargoController::update($id);
});

//
Route::delete('/cargo/{id}',function(){
    CargoController::delete($id);
});