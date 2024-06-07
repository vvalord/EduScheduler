<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table = 'asignaturas';
    protected $guarded = [];

    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'curso_profesor_asignatura');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_profesor_asignatura');
    }

    public function asignaturasCursos()
    {
        return $this->hasMany(Curso_Profesor_Asignatura::class);
    }

    // Relación con cursos a través de la tabla intermedia 'course_subject'
    public function course()
    {
        return $this->belongsToMany(Curso::class, 'curso_asignaturas');
    }

    // Relación con cursos y profesores a través de la tabla intermedia 'course_subject_teacher'
    public function courses()
    {
        return $this->belongsToMany(Curso::class, 'curso_profesor_asignatura')
            ->withPivot('profesor_id');
    }

    // Relación directa con profesores a través de la tabla intermedia 'course_subject_teacher'
    public function teachers()
    {
        return $this->belongsToMany(Profesor::class, 'curso_profesor_asignatura')
            ->withPivot('curso_id');
    }

    public static function equals(Asignatura $asig1, Asignatura $asig2){
        $equal=true;

        if($asig1->nombre!=$asig2->nombre)
            $equal=false;
        if($asig1->cod!=$asig2->cod)
            $equal=false;
        if($asig1->horas!=$asig2->horas)
            $equal=false;

        return $equal;

    }
}
