<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    protected $table = 'profesores';
    protected $guarded=[];

    public function asignacion()
    {
        return $this->belongsToMany(Cargo::class, 'asignacion_cargos');
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'curso_profesor_asignatura');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_profesor_asignatura');
    }

    public function asignaturasCursos()
    {
        return $this->hasMany(Curso_Profesor_Asignatura::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Curso::class, 'curso_profesor_asignatura')
            ->withPivot('asignatura_id', 'horas');
    }

    public function subjects()
    {
        return $this->belongsToMany(Asignatura::class, 'curso_profesor_asignatura')
            ->withPivot('curso_id', 'horas');
    }

    public static function equals(Profesor $prof1, Profesor $prof2){
        $equal=true;

        if($prof1->nombre!=$prof2->nombre)
            $equal=false;
        if($prof1->cod!=$prof2->cod)
            $equal=false;
        if($prof1->email!=$prof2->email)
            $equal=false;
        if($prof1->especialidad!=$prof2->especialidad)
            $equal=false;
        if($prof1->departamento!=$prof2->departamento)
            $equal=false;
        return $equal;

    }
}
