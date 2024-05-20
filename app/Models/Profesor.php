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
        return $this->hasMany(Asignacion_Cargo::class);
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'curso_profesor_asignatura');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_profesor_asignatura');
    }
}
