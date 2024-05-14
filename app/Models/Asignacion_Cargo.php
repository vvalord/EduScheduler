<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion_Cargo extends Model
{
    use HasFactory;
    protected $table = 'asignacion_cargos';
    protected $guarded = [];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
}
