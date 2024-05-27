<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function asignacion()
    {
        return $this->belongsToMany(Profesor::class, 'asignacion_cargos');
    }

    public static function equals(Cargo $cargo1, Cargo $cargo2){
        $equal=true;

        if($cargo1->nombre!=$cargo2->nombre)
            $equal=false;

        return $equal;

    }
}
