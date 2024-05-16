<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'curso_profesor_asignatura');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_profesor_asignatura');
    }
}
