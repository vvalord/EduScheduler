<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Cargo;

class CargoController extends Controller
{
    //Si ves esto, ignora este controller
    public function insert()
    {
        $datos = request()->validate([
            'horas' => ['required', 'min:0','max:18', 'integer']
        ]);

        $cargo = Cargo::create($datos);

        return redirect('/cargos');
    }

    public function searchAll(){
        //Hecho asi y no como consulta preparada por que supuestamente en limit y offset no funcionan las variables preparadas
        //Probar como preparada antes de dejarla como definitiva ':offset'
        $cargos=DB::select("SELECT * FROM cargos;");
        return $cargos;
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
        $cargos=DB::select("SELECT * FROM cargos where nombre like '%?%' limit 10 OFFSET $offset;",[1, $name]);
        return $cargos;
    }
    public function searchById(int $id){
        $cargo=DB::select("SELECT * FROM cargos where id=?",[1, $id]);
        return $cargo;
    }

    public function update(int $id){
        $datos = request()->validate([
            'horas' => ['required', 'min:0','max:18', 'integer']
        ]);
        $cargo=CargoController::searchById($id);
        if($datos['nombre']!=$cargo['nombre']){
            DB::update(
                'update cargos set nombre = ? where id = ?',
                [$datos['nombre'],$id]
            );
        }
        if($datos['horas']!=$cargo['horas']){
            DB::update(
                'update cargos set horas = ? where id = ?',
                [$datos['horas'],$id]
            );
        }
        if($datos['horario']!=$cargo['horario']){
            DB::update(
                'update cargos set horario = ? where id = ?',
                [$datos['horario'],$id]
            );
        }
        return redirect('/cargos');
    }
    public function delete(int $id){
        $deleted = DB::delete('delete from cargos where id=?',[1, $id]);
        return redirect('/cargos');
    }

}
