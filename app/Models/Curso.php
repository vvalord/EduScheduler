<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'curso_profesor_asignatura');
    }

    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'curso_profesor_asignatura');
    }
}
