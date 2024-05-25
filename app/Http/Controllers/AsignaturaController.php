<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Asignatura;

class AsignaturaController extends Controller
{
    //Si ves esto, ignora este controller
    public function insert()
    {
        $datos = request()->validate([
            'cod' => ['required','min:3','max:5', Rule::unique('asignaturas', 'cod')]
        ]);

        $asignatura = Asignatura::create($datos);

        return redirect('/asignaturas');
    }

    public function searchAll(){
        //Hecho asi y no como consulta preparada por que supuestamente en limit y offset no funcionan las variables preparadas
        //Probar como preparada antes de dejarla como definitiva ':offset'
        $asignaturas=DB::select("SELECT * FROM asignaturas;");
        return $asignaturas;
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
        $asignaturas=DB::select("SELECT * FROM asignaturas where nombre like '%?%' limit 10 OFFSET $offset;",[1, $name]);
        return $asignaturas;
    }
    public function searchById(int $id){
        $asignatura=DB::select("SELECT * FROM asignaturas where id=?",[1, $id]);
        return $asignatura;
    }

    public function update(int $id){
        $datos = request()->validate([
            'cod' => ['required','min:3','max:5', Rule::unique('asignaturas', 'cod')]
        ]);
        $asignatura=AsignaturaController::searchById($id);
        if($datos['nombre']!=$asignatura['nombre']){
            DB::update(
                'update asignaturas set nombre = ? where id = ?',
                [$datos['nombre'],$id]
            );
        }
        if($datos['horas']!=$asignatura['horas']){
            DB::update(
                'update asignaturas set horas = ? where id = ?',
                [$datos['horas'],$id]
            );
        }
        if($datos['cod']!=$asignatura['cod']){
            DB::update(
                'update asignaturas set cod = ? where id = ?',
                [$datos['cod'],$id]
            );
        }
        return redirect('/asignaturas');
    }
    public function delete(int $id){
        $deleted = DB::delete('delete from asignaturas where id=?',[1, $id]);
        return redirect('/asignaturas');
    }

}
