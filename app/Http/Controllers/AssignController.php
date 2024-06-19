<?php

namespace App\Http\Controllers;

use App\Models\Asignacion_Cargo;
use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Curso_Profesor_Asignatura;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AssignController extends Controller
{
    public function create()
    {
        $subjects = Asignatura::all();
        //$courses = Curso::with('asignaturas')->get();
        $teachers = Profesor::with(['asignaturasCursos.curso', 'asignaturasCursos.asignatura'])->get();
        $unassignedSubjects = Curso::coursesWithUnassignedSubjects();
        $formattedTeachers = $teachers->map(function ($teacher) {
            $reduction = Asignacion_Cargo::where('profesor_id', $teacher->id)->get();
            if (!isset($reduction[0])){
                $reduction = 0;
            } else {
                $reduction = $reduction[0]['reduccion'];
            }
            $horasTotales = Curso_Profesor_Asignatura::where('profesor_id', $teacher->id)->sum('horas') + $reduction;
            return [
                'id' => $teacher->id,
                'nombre' => $teacher->nombre,
                'horasTotales' => $horasTotales,
                'reduccion' => $reduction,
                'asignaturas' => $teacher->asignaturasCursos->map(function ($cursoAsignaturaProfesor) {
                    return [
                        'id' => $cursoAsignaturaProfesor->id,
                        'curso_id' => $cursoAsignaturaProfesor->curso->id,
                        'curso' => $cursoAsignaturaProfesor->curso->cod,
                        'asignatura_id' => $cursoAsignaturaProfesor->asignatura->id,
                        'asignatura' => $cursoAsignaturaProfesor->asignatura->nombre,
                        'horas' => $cursoAsignaturaProfesor->horas
                    ];
                })
            ];
        });
        return Inertia::render('Home', [
            'profesores' => $formattedTeachers,
            'asignaturas' => $subjects,
            'cursos' => $unassignedSubjects
        ]);
    }

    public function insert()
    {
        request()->validate([
            'cursoId' => ['required'],
            'asignaturaId' => ['required'],
            'horas' => ['required'],
        ]);
        $teacher = Profesor::findOrFail(request()->profesorId);

        $course = request()->cursoId;
        $subject = request()->asignaturaId;
        $horas = request()->horas;
        // Asignar la asignatura al profesor
        $teacher->subjects()->attach($subject, [
            'curso_id' => $course,
            'horas'=> $horas
        ]);
        return redirect('/');
    }

    public function delete($id) {
        $assign = Curso_Profesor_Asignatura::find($id);
        $assign->delete();
        return redirect('/');
    }
}
