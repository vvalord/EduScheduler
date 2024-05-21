<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Curso;

class CursoController extends Controller
{
    //Si ves esto, ignora este controller
    public function insert()
    {
        $datos = request()->validate([
            'cod' => ['required','min:3','max:5', Rule::unique('cursos', 'cod')]
        ]);

        $curso = Curso::create($datos);

        return redirect('/cursos');
    }

    public function searchAll(){
        //Hecho asi y no como consulta preparada por que supuestamente en limit y offset no funcionan las variables preparadas
        //Probar como preparada antes de dejarla como definitiva ':offset'
        $cursos=DB::select("SELECT * FROM cursos;");
        return $cursos;
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
        $cursos=DB::select("SELECT * FROM cursos where nombre like '%?%' limit 10 OFFSET $offset;",[1, $name]);
        return $cursos;
    }
    public function searchById(int $id){
        $curso=DB::select("SELECT * FROM cursos where id=?",[1, $id]);
        return $curso;
    }

    public function update(int $id){
        $datos = request()->validate([
            'cod' => ['required','min:3','max:5', Rule::unique('cursos', 'cod')]
        ]);
        $curso=CursoController::searchById($id);
        if($datos['nombre']!=$curso['nombre']){
            DB::update(
                'update cursos set nombre = ? where id = ?',
                [$datos['nombre'],$id]
            );
        }
        if($datos['cod']!=$curso['cod']){
            DB::update(
                'update cursos set cod = ? where id = ?',
                [$datos['cod'],$id]
            );
        }
        return redirect('/cursos');
    }
    public function delete(int $id){
        $deleted = DB::delete('delete from cursos where id=?',[1, $id]);
        return redirect('/cursos');
    }

}
