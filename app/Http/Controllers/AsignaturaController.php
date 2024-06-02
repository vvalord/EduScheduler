<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Asignatura;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AsignaturaController extends Controller
{
    
    /**
     * Insert
     *
     * Takes the data sent from the form and create a new assignment
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function insert()
    {
        //We validate the data
        $datos = request()->validate([
            'nombre' => ['required'],
            'cod' => ['required','max:5', Rule::unique('asignaturas', 'cod')],
            'horas' => ['required','numeric','max:10']
        ]);

        //With the validated data, we try to create the new assignment
        try {
            Asignatura::create($datos);
            //If an error occurs, we send the exception
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

    /**
     * Search
     *
     * Sends the list of assignments found in the database
     * 
     * @return \Inertia\Response List of assignments
     */
    public function search(){
        //Obtain all the assignments
        $asignaturas = Asignatura::all();
        if(empty($asignaturas['items'])){
            $ret=[];
            //Return only what's important
            foreach($asignaturas as $asignatura){
                $ret[]=[
                    'id'=>$asignatura['id'],
                    'nombre'=>$asignatura['nombre'],
                    'cod'=>$asignatura['cod'],
                    'horas'=>$asignatura['horas']
                ];
            }
        }else{
            $ret=false;
        }
        return Inertia::render('Asignaturas',[
            'asignaturas'=>$ret
        ]);
    }
    /*
    public function searchById(int $id){
        $asignatura=DB::select("SELECT * FROM asignaturas where id=?",[1, $id]);
        return $asignatura;
    }
*/    
    /**
     * Update
     *
     * Takes the data sent from the form and updates an assignment
     * 
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id){
        try{
            $datos = request()->validate([
                'nombre' => ['required'],
                'cod' => ['required','max:5', Rule::unique('asignaturas', 'cod')->ignore($id)],
                'horas' => ['required','numeric','max:10']
            ]);
        }catch(Exception $exception){
            dd($exception);
        }
        $asig=Asignatura::find($id);

        //Creamos una instancia que no se guarda en la base de datos
        $newAsig=Asignatura::make($datos);
        //Comprobamos si sus atributos son los mismos
        if(Asignatura::equals($newAsig,$asig)){
            dd("Los datos son iguales");
        }else{
            try{
                Asignatura::find($id)->update($datos);
            } catch (\Illuminate\Database\QueryException $exception) {
                // You can check get the details of the error using `errorInfo`:
                $errorInfo = $exception->errorInfo;
                // Return the response to the client..
                echo $errorInfo;
            }
        }
        return redirect('/asignaturas');
    }    
    /**
     * Delete
     * 
     * Delete an assignment
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(int $id){
        try{
            Asignatura::find($id)->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            echo $errorInfo;
        }
        return redirect('/asignaturas');
    }

}
