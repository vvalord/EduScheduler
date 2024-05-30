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

    public static function equals(Asignacion_Cargo $prof1, Asignacion_Cargo $prof2){
        $equal=true;

        if($prof1->cargo_id!=$prof2->cargo_id)
            $equal=false;
        if($prof1->turno!=$prof2->turno)
            $equal=false;
        //if($prof1->horas!=$prof2->horas)
        //    $equal=false;
        return $equal;

    }
}
