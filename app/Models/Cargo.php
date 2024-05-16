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
        return $this->hasMany(Asignacion_Cargo::class);
    }
}
