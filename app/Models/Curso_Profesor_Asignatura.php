<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso_Profesor_Asignatura extends Model
{
    use HasFactory;

    protected $table = 'curso_profesor_asignatura';

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }
}
