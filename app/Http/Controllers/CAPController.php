<?php

namespace App\Http\Controllers;

use App\Models\Curso_Profesor_Asignatura;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CAPController extends Controller
{
    /**
     * Insert
     *
     * Takes the data sent from the form and create a new course
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public static function crear($curso, $asignatura)
    {


        //With the validated data, we try to create the new course
        try{
         Curso_Profesor_Asignatura::create();
            //If an error occurs, we send the exception
        } catch (\Illuminate\Database\QueryException $exception) {
            dd('error');
        }
    }

    /*
    public function searchAll(){
        //Hecho asi y no como consulta preparada por que supuestamente en limit y offset no funcionan las variables preparadas
        //Probar como preparada antes de dejarla como definitiva ':offset'
        $cursos=DB::select("SELECT * FROM cursos;");
        return $cursos;
    }*/

    /**
     * Search
     *
     * Sends the list of courses found in the database
     * 
     * @return \Inertia\Response List of courses
     */
    public function search(){
        //Obtain all the courses
        $cursos = Curso_Profesor_Asignatura::all();
        if(empty($cursos['items'])){
            $ret=[];
            //Return only what's important
            foreach($cursos as $curso){
                if(isset($curso['profesor_id']))
                    $ret[]=['id'=>$curso['id'],'curso_id'=>$curso['curso_id'],'asignatura_id'=>$curso['asignatura_id'],'profesor_id'=>$curso['profesor_id']];
                else
                    $ret[]=['id'=>$curso['id'],'curso_id'=>$curso['curso_id'],'asignatura_id'=>$curso['asignatura_id']];
            }
        }else{
            $ret=false;
        }
        return Inertia::render('Home',[
            'cursos'=>$ret
        ]);
    
    }

    

     /**
     * Update
     *
     * Takes the data sent from the form and updates a course
     * 
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(){
        try{
            $datos = request()->validate([
                'curso_id'=> ['required'],
                'asignatura_id'=> ['required'],
                'profesor_id' => ['required'],
            ]);
        }catch(Exception $exception){
            dd($exception);
        }
            try{
                $asignacion=Curso_Profesor_Asignatura::where('curso_id',$datos['curso_id'])->where('asignatura_id',$datos['asignatura_id'])->get()->first();
                $asignacion->profesor_id = $datos['profesor_id'];
            } catch (\Illuminate\Database\QueryException $exception) {
                // You can check get the details of the error using `errorInfo`:
                $errorInfo = $exception->errorInfo;
                // Return the response to the client..
                echo $errorInfo;
            }
        return redirect('/home');
    }

    /**
     * Delete
     * 
     * Delete a course
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(int $id){
        try{
            Curso_Profesor_Asignatura::find($id)->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            echo $errorInfo;
        }
    }
}
