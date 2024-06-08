<?php

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfesorController;
use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Curso_Profesor_Asignatura;
use Illuminate\Http\Request;
use App\Models\Profesor;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//HOME
Route::get('/', function () {
    //$profesores = Profesor::with(['asignaturasCursos.curso', 'asignaturasCursos.asignatura'])->get();
    $asignaturas = Asignatura::all();
    $cursos = Curso::with('asignaturas')->get();;
    $ret = [];
    $i = 0;
    /**foreach ($profesores as $profesor) {
        $ret[$i] = [
            'id' => $profesor->id,
            'nombre' => $profesor->nombre,
            'total' => $profesor->total_horas
        ];
        $cursos = [];
        foreach ($profesor->asignaturasCursos as $relation) {
            $cursoNombre = $relation->curso->cod;
            if (!isset($cursos[$cursoNombre])) {
                $cursos[$cursoNombre] = [];
            }
            $cursos[$cursoNombre][] = $relation->asignatura->cod;
            $ret[$i]['asignaturas'][] = [
                'curso' => $relation->curso->cod,
                'asignatura' => $relation->asignatura->cod,
                'horas' => 0
            ];
        }
        $i++;
    }
    //dd($ret);*/
    $teachers = Profesor::with(['asignaturasCursos.curso', 'asignaturasCursos.asignatura'])->get();

    $formattedTeachers = $teachers->map(function ($teacher) {
        return [
            'id' => $teacher->id,
            'nombre' => $teacher->nombre,
            'asignaturas' => $teacher->asignaturasCursos->map(function ($courseSubjectTeacher) {
                return [
                    'id' => $courseSubjectTeacher->id,
                    'curso_id' => $courseSubjectTeacher->curso->id,
                    'curso' => $courseSubjectTeacher->curso->nombre,
                    'asignatura_id' => $courseSubjectTeacher->asignatura->id,
                    'asignatura' => $courseSubjectTeacher->asignatura->nombre,
                    'horas' => $courseSubjectTeacher->horas
                ];
            })
        ];
    });
    return Inertia::render('Assign', [
        'profesores' => $formattedTeachers,
        'asignaturas' => $asignaturas,
        'cursos' => $cursos
    ]);
});
/*
Route::get('/profesores', function () {
    $ret = Profesor::all();
    //dd($ret);
    return Inertia::render('Profesores', [
        'profesores' => $ret
    ]);
});*/

/////
//PROFESORES
/////
//Listado profesores
Route::get('/profesores', [ProfesorController::class,'search']);

//Enviar datos from Profesor
Route::post('/profesores',[ProfesorController::class,'insert']);

//Update form sent data
Route::put('/profesores/{id}',[ProfesorController::class,'update']);

//Delete Profesor
Route::delete('/profesores/{id}',[ProfesorController::class,'delete']);

/////
//ASIGNATURAS
/////
//Listado asignaturas
Route::get('/asignaturas', [AsignaturaController::class,'search']);

//Enviar datos from Asignatura
Route::post('/asignaturas',[AsignaturaController::class,'insert']);

//Update form sent data
Route::put('/asignaturas/{id}',[AsignaturaController::class,'update']);

//Delete Asignatura
Route::delete('/asignaturas/{id}',[AsignaturaController::class,'delete']);

/////
//CURSOS
/////
//Listado cursos
Route::get('/cursos', [CursoController::class,'search']);

//Enviar datos from Curso
Route::post('/cursos',[CursoController::class,'insert']);

//Update form sent data
Route::put('/cursos/{id}',[CursoController::class,'update']);

//Delete Curso
Route::delete('/cursos/{id}',[CursoController::class,'delete']);

/////
//CARGOS
/////
//Listado cargos
Route::get('/cargos', [CargoController::class,'search']);
Route::get('/cargosAll', [CargoController::class,'searchAll']);
//Enviar datos from Cargo
Route::post('/cargos',[CargoController::class,'insert']);

//Update form sent data
Route::put('/cargos/{id}',[CargoController::class,'update']);

//Delete Cargo
Route::delete('/cargos/{id}',[CargoController::class,'delete']);


Route::post('/asignarAsignatura', function () {
    request()->validate([
        'cursoId' => ['required'],
        'asignaturaId' => ['required'],
        'horas' => ['required'],
    ]);
    $profesor = Profesor::findOrFail(request()->profesorId);

    $curso = request()->cursoId;
    $asignatura = request()->asignaturaId;
    $horas = request()->horas;
    //dd($curso);
    // Asignar la asignatura al profesor
    $profesor->subjects()->attach($asignatura, [
        'curso_id' => $curso,
        'horas'=> $horas
    ]);
    return redirect('/');
});

Route::delete('desasignarAsignatura/{id}', function ($id) {
    $asignacion = Curso_Profesor_Asignatura::find($id);
    $asignacion->delete();
    return redirect('/');
});
