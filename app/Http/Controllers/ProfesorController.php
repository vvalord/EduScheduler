<?php

namespace App\Http\Controllers;

use App\Models\Asignacion_Cargo;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Profesor;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProfesorController extends Controller
{
    /**
     * Insert
     *
     * Takes the data sent from the form and create a new teacher
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function insert()
    {
        //We validate the data
        $datos = request()->validate([
            'nombre' => ['required'],
            'email' => ['required', 'min:5','max:50', 'email', Rule::unique('profesores', 'email')],
            'cod' => ['required','max:5', Rule::unique('profesores', 'cod')],
            'especialidad' => ['required'],
            'departamento' => ['required']
        ]);
        $datos['total_horas']=0;

        //With the validated data, we try to create the new teacher
        try {
             $profesor=Profesor::create($datos);
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            echo $errorInfo;
        }

        if(request()->validate(['cargo_id' => ['required']])){
            $datosAsignacion=request()->validate([
                'cargo_id' => ['required'],
                //'horas' => ['required'],
                'turno' => ['required']]);
            $datosAsignacion['profesor_id']=$profesor['id'];
            try {
                Asignacion_Cargo::create($datosAsignacion);
           } catch (\Illuminate\Database\QueryException $exception) {
               dd("error");
           }
        }

        return redirect('/profesores');
    }

    /*
    public function searchAll(){

        //Hecho asi y no como consulta preparada por que supuestamente en limit y offset no funcionan las variables preparadas
        //Probar como preparada antes de dejarla como definitiva ':offset'
        $profesores=DB::select("SELECT * FROM profesores;");
        return $profesores;
    }*/

    /**
     * Search
     *
     * Sends the list of teachers found in the database
     *
     * @return \Inertia\Response List of teachers
     */
    public function search(){
        //Obtain all the teachers
        $profesores = Profesor::all();
        if(empty($profesores['items'])){
            $ret=[];
            //Return only what's important
            foreach($profesores as $profesor){
                if($asignacion=Asignacion_Cargo::query()->where('profesor_id',$profesor['id'])->get()->first()){
                $ret[]=['id'=>$profesor['id'],'nombre'=>$profesor['nombre'],'cod'=>$profesor['cod'],'email'=>$profesor['email'],'especialidad'=>$profesor['especialidad'],
                'cargo_id'=>$asignacion->cargo_id,'turno'=>$asignacion->turno,
                'departamento'=>$profesor['departamento'],'total_horas'=>$profesor['total_horas']];
                }else{
                    $ret[]=['id'=>$profesor['id'],'nombre'=>$profesor['nombre'],'cod'=>$profesor['cod'],'email'=>$profesor['email'],'especialidad'=>$profesor['especialidad'],
                'departamento'=>$profesor['departamento'],'total_horas'=>$profesor['total_horas']];
                }
            }
        }else{
            $ret=false;
        }
        return Inertia::render('Profesores',[
            'profesores'=>$ret
        ]);
    }
    /*
    public function searchById(int $id){
        $profesor=DB::select("SELECT * FROM profesores where id=?",[1, $id]);
        return $profesor;
    }*/

    /**
     * Update
     *
     * Takes the data sent from the form and updates a teacher
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */public function update(int $id){
        try{
            $datos = request()->validate([
                'nombre' => ['required'],
                'cod' => ['required','max:5', Rule::unique('profesores', 'cod')->ignore($id)],
                'email' => ['required','min:5','max:50', Rule::unique('profesores', 'email')->ignore($id)],
                'especialidad' => ['required'],
                'departamento' => ['required']
            ]);
        }catch(Exception $exception){
            dd($exception);
        }
        $prof=Profesor::find($id);

        //Creamos una instancia que no se guarda en la base de datos
        $newProf=Profesor::make($datos);
        //Comprobamos si sus atributos son los mismos
        if(!Profesor::equals($newProf,$prof)){

            try{
                Profesor::find($id)->update($datos);
            } catch (\Illuminate\Database\QueryException $exception) {
                // You can check get the details of the error using `errorInfo`:
                $errorInfo = $exception->errorInfo;
                // Return the response to the client..
                echo $errorInfo;
            }
        }

        if(request()->validate(['cargo_id' => ['required']])){
            $datosAsignacion=request()->validate([
                'cargo_id' => ['required'],
                //'horas' => ['required'],
                'turno' => ['required']]);
                $asignacion=Asignacion_Cargo::query()->where('profesor_id',$id)->get()->first();
                $datosAsignacion['profesor_id']=$id;
                $newAsignacion=Asignacion_Cargo::make($datosAsignacion);
                if(!Asignacion_Cargo::equals($asignacion,$newAsignacion)){
                    try{
                        Asignacion_Cargo::query()->where('profesor_id',$id)->get()->first()->update($datosAsignacion);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        dd("error");
                    }
                }
        }
        return redirect('/profesores');
    }

    /**
     * Delete
     *
     * Delete a teacher
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(int $id){
        try{
            Profesor::find($id)->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            echo $errorInfo;
        }
        return redirect('/profesores');
    }

}
