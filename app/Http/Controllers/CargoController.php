<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{
    //Si ves esto, ignora este controller
    public static function insert()
    {
        $datos = request()->validate([
            'horas' => ['required', 'min:0','max:18', 'integer']
        ]);

        try {
            Cargo::create($datos);
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;
        
            // Return the response to the client..
        }
        return redirect('/cargos');
    }

    public function searchAll(){
        $cargos=Cargo::all()->through(fn($cargo)=>[
            'id'=>$cargo->id,
            'nombre'=>$cargo->nombre
        ]);
        return $cargos;
    }
    public static function search(){
        /*if($page==null){
            $page=1;
        }
        $offset=10*($page-1);
        if($name==null){
            $name="";
        }
        //Hecho asi y no como consulta preparada por que supuestamente en limit y offset no funcionan las variables preparadas
        //Probar como preparada antes de dejarla como definitiva ':offset'
        $cargos=DB::select("SELECT * FROM cargos where nombre like '%?%' limit 10 OFFSET $offset;",[1, $name]);
        return $cargos;*/
        $cargos=Cargo::query()
        ->when(Request::input('search'),function ($query,$search){
            $query->where('nombre','like',"%{$search}%");
        })
        ->paginate(10)
        ->withQueryString()
        ->through(fn($cargo)=>[
            'id'=>$cargo->id,
            'nombre'=>$cargo->nombre
        ]);
        return $cargos;
    }
    public static function searchById(int $id){
        //$cargo=DB::select("SELECT * FROM cargos where id=?",[1, $id]);
        $cargo=Cargo::query()->find($id);
        return $cargo;
    }

    public static function update(int $id){
        $datos = request()->validate([
            'horas' => ['required', 'min:0','max:18', 'integer']
        ]);
        $cargo=CargoController::searchById($id);
        if($datos['nombre']!=$cargo->nombre||$datos['horario']!=$cargo->horario||$datos['horas']!=$cargo->horas){
        if($datos['nombre']!=$cargo->nombre){
            $cargo->nombre=$datos['nombre'];
            /*DB::update(
                'update cargos set nombre = ? where id = ?',
                [$datos['nombre'],$id]
            );*/
        }
        if($datos['horas']!=$cargo->horas){
            $cargo->horas=$datos['horas'];
            /*DB::update(
                'update cargos set horas = ? where id = ?',
                [$datos['horas'],$id]
            );*/
        }
        if($datos['horario']!=$cargo->horario){
            $cargo->horario=$datos['horario'];
            /*DB::update(
                'update cargos set horario = ? where id = ?',
                [$datos['horario'],$id]
            );*/
        }
        $cargo->save();
    }
        return redirect('/cargos');

    }
    public static function delete(int $id){
        //$deleted = DB::delete('delete from cargos where id=?',[1, $id]);
        Cargo::query()->where('id',$id)->delete();
        return redirect('/cargos');
    }

}
