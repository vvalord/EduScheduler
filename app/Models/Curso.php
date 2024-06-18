<?php

namespace App\Models;

use App\Http\Controllers\ProfesorController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $guarded = [];

    /*public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'curso_profesor_asignatura', 'curso_id', 'asignatura_id');
    }*/

    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'curso_profesor_asignatura');
    }

    public function asignaturasCursos()
    {
        return $this->hasMany(Curso_Profesor_Asignatura::class);
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'curso_asignaturas');
    }

    public function courseSubjectTeachers()
    {
        return $this->hasMany(Curso_Profesor_Asignatura::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Asignatura::class, 'curso_profesor_asignatura')
            ->withPivot('profesor_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Profesor::class, 'curso_profesor_asignatura')
            ->withPivot('asignatura_id');
    }

    public static function equals(Curso $curso1, Curso $curso2){
        $equal=true;

        if($curso1->nombre!=$curso2->nombre)
            $equal=false;
        if($curso1->cod!=$curso2->cod)
            $equal=false;

        return $equal;

    }
}
