<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Asignatura;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AsignaturaController extends Controller
{
    //Si ves esto, ignora este controller
    public function insert()
    {
        $datos = request()->validate([
            'nombre' => ['required'],
            'cod' => ['required','min:3','max:5', Rule::unique('asignaturas', 'cod')],
            'horas' => ['required','numeric','max:10']
        ]);

        try {
            Asignatura::create($datos);
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            echo $errorInfo;
        }

        return redirect('/asignaturas');
    }
/*
    public function searchAll(){
        //Hecho asi y no como consulta preparada por que supuestamente en limit y offset no funcionan las variables preparadas
        //Probar como preparada antes de dejarla como definitiva ':offset'
        $asignaturas=DB::select("SELECT * FROM asignaturas;");
        return $asignaturas;
    }*/
    public function search(){
        $asignaturas = Asignatura::all();
        $ret=[];
        foreach($asignaturas as $asignatura){
            $ret[]=['id'=>$asignatura['id'],'nombre'=>$asignatura['nombre'],'cod'=>$asignatura['cod'],'horas'=>$asignatura['horas']];
        }
        return Inertia::render('Asignaturas',[
            //Obtener los dato del cargo para introudcirlo en el input
            'asignaturas'=>$ret
        ]);
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
        $asignatura = Asignatura::find($id);
        $asignatura->delete();
        return redirect('/asignaturas');
    }

}
