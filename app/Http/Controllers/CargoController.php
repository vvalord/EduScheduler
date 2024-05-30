<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CargoController extends Controller
{    
    /**
     * Insert
     *
     * Takes the data sent from the form and create a new position
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function insert()
    {
        //dd(request());
        //We validate the data
        $datos = request()->validate([
            'nombre' => ['required']
        ]);

        //With the validated data, we try to create the new position
        try {
            Cargo::create($datos);
            //If an error occurs, we send the exception
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            echo $errorInfo;
        }
        return redirect('/cargos');
    }

    /*
    public function searchAll(){
        $cargos=Cargo::all()->through(fn($cargo)=>[
            'id'=>$cargo->id,
            'nombre'=>$cargo->nombre
        ]);
        return $cargos;
    }*/
    /**
     * Search
     *
     * Sends the list of positions found in the database
     * 
     * @return \Inertia\Response List of positions
     */
    public function search(){
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

        //Obtain all the positions
        $cargos = Cargo::all();
        $ret=[];
        //Return only what's important
        foreach($cargos as $cargo){
            $ret[]=[
                'id' => $cargo['id'],
                'nombre'=>$cargo['nombre']
            ];
        }
        return Inertia::render('Cargos',[
            'cargos'=>$ret
        ]);
    }

    /*
    public function searchById(int $id){
        //$cargo=DB::select("SELECT * FROM cargos where id=?",[1, $id]);
        $cargo=Cargo::query()->find($id);
        return $cargo;
    }
    */

     /**
     * Update
     *
     * Takes the data sent from the form and updates a position
     * 
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id){
        //dd(request());
        try{
            $datos = request()->validate([
                'nombre' => ['required']
            ]);
        }catch(Exception $exception){
            dd($exception);
        }
        $cargo=Cargo::find($id);
        //Primer metodo
        /*
        if($datos['nombre']!=$cargo->nombre||$datos['horario']!=$cargo->horario||$datos['horas']!=$cargo->horas){
        if($datos['nombre']!=$cargo->nombre){
            $cargo->nombre=$datos['nombre'];
        }
        if($datos['horas']!=$cargo->horas){
            $cargo->horas=$datos['horas'];
        }
        if($datos['horario']!=$cargo->horario){
            $cargo->horario=$datos['horario'];
        }
        $cargo->save();
        */

        //Segundo metodo
        //Creamos una instancia que no se guarda en la base de datos
        $newCargo=Cargo::make($datos);
        //Comprobamos si sus atributos son los mismos
        if(Cargo::equals($newCargo,$cargo)){
            dd("Los datos son iguales");
        }else{
            try{
                Cargo::find($id)->update($datos);
            } catch (\Illuminate\Database\QueryException $exception) {
                // You can check get the details of the error using `errorInfo`:
                $errorInfo = $exception->errorInfo;
                // Return the response to the client..
                echo $errorInfo;
            }
        }
    
        return redirect('/cargos');

    }

    /**
     * Delete
     * 
     * Delete a position
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(int $id){
        //$deleted = DB::delete('delete from cargos where id=?',[1, $id]);
        //Cargo::query()->where('id',$id)->delete();
        try{
            Cargo::find($id)->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            echo $errorInfo;
        }
        return redirect('/cargos');
    }

}
