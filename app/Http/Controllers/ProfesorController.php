<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Profesor;

class ProfesorController extends Controller
{
    //Si ves esto, ignora este controller
    public function insert()
    {
        $datos = request()->validate([
            'email' => ['required', 'min:5','max:50', 'email', Rule::unique('profesores', 'email')],
            'cod' => ['required','min:3','max:5', Rule::unique('profesores', 'cod')]
        ]);
        $datos['total_horas']=0;

        $user = Profesor::create($datos);

        return redirect('/profesores');
    }

    public function searchAll(){

        //Hecho asi y no como consulta preparada por que supuestamente en limit y offset no funcionan las variables preparadas
        //Probar como preparada antes de dejarla como definitiva ':offset'
        $profesores=DB::select("SELECT * FROM profesores;");
        return $profesores;
    }
    public function search(?int $page,?string $name){
        if($page==null){
            $page=1;
        }
        $offset=10*($page-1);
        if($name==null){
            $name="";
        }
        //Hecho asi y no como consulta preparada por que supuestamente en limit y offset no funcionan las variables preparadas
        //Probar como preparada antes de dejarla como definitiva ':offset'
        $profesores=DB::select("SELECT * FROM profesores where nombre like '%?%' limit 10 OFFSET $offset;",[1, $name]);
        return $profesores;
    }
    public function searchById(int $id){
        $profesor=DB::select("SELECT * FROM profesores where id=?",[1, $id]);
        return $profesor;
    }

    public function update(int $id){
        $datos = request()->validate([
            'email' => ['required', 'min:5','max:50', 'email'],
            'cod' => ['required','min:3','max:5']
        ]);
        $profesor=ProfesorController::searchById($id);
        if($datos['nombre']!=$profesor['nombre']){
            DB::update(
                'update profesores set nombre = ? where id = ?',
                [$datos['nombre'],$id]
            );
        }
        if($datos['email']!=$profesor['email']){
            DB::update(
                'update profesores set email = ? where id = ?',
                [$datos['email'],$id]
            );
        }
        if($datos['cod']!=$profesor['cod']){
            DB::update(
                'update profesores set cod = ? where id = ?',
                [$datos['cod'],$id]
            );
        }
        if($datos['especialidad']!=$profesor['especialidad']){
            DB::update(
                'update profesores set especialidad = ? where id = ?',
                [$datos['especialidad'],$id]
            );
        }
        if($datos['departamento']!=$profesor['departamento']){
            DB::update(
                'update profesores set departamento = ? where id = ?',
                [$datos['departamento'],$id]
            );
        }
        return redirect('/profesores');
    }
    public function delete(int $id){
        $deleted = DB::delete('delete from profesores where id=?',[1, $id]);
        return redirect('/profesores');
    }

}
