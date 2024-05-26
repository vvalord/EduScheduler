<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Profesor;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProfesorController extends Controller
{
    //Si ves esto, ignora este controller
    public function insert()
    {
        $datos = request()->validate([
            'nombre' => ['required'],
            'email' => ['required', 'min:5','max:50', 'email', Rule::unique('profesores', 'email')],
            'cod' => ['required','min:3','max:5', Rule::unique('profesores', 'cod')],
            'especialidad' => ['required'],
            'departamento' => ['required']
        ]);
        $datos['total_horas']=0;

        try {
             Profesor::create($datos);
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            echo $errorInfo;
        }

        return redirect('/profesores');
    }

    public function searchAll(){

        //Hecho asi y no como consulta preparada por que supuestamente en limit y offset no funcionan las variables preparadas
        //Probar como preparada antes de dejarla como definitiva ':offset'
        $profesores=DB::select("SELECT * FROM profesores;");
        return $profesores;
    }
    public function search(){
        $profesores = Profesor::all();
        $ret=[];
        foreach($profesores as $profesor){
            $ret[]=['nombre'=>$profesor['nombre'],'cod'=>$profesor['cod'],'email'=>$profesor['email'],'especialidad'=>$profesor['especialidad'],'departamento'=>$profesor['departamento'],'total_horas'=>$profesor['total_horas']];
        }
        return Inertia::render('Profesores',[
            //Obtener los dato del cargo para introudcirlo en el input
            'profesores'=>$ret
        ]);
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
