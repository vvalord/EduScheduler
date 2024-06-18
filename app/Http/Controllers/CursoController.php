<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Curso_Profesor_Asignatura;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CursoController extends Controller
{
    /**
     * Insert
     *
     * Takes the data sent from the form and create a new course
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function insert()
    {
        //We validate the data
        $datos = request()->validate([
            'nombre' => ['required'],
            'cod' => ['required','max:5', Rule::unique('cursos', 'cod')]
        ]);

        //With the validated data, we try to create the new course
        try{
         $curso = Curso::create($datos);
         $curso->asignaturas()->attach(request()->asignaturas);
            //If an error occurs, we send the exception
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            echo $errorInfo;
        }
        return redirect('/cursos');
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
        $subjects = Asignatura::all();
        //Obtain all the courses
        $courses = Curso::with('asignaturas')->get();
        if(empty($courses['items'])){
            $ret=[];
            //Return only what's important
            foreach($courses as $course){
                $courseSubject = [];
                foreach ($course['asignaturas'] as $subject){
                    $courseSubject[] = $subject['id'];
                }
                $ret[]=['id'=>$course['id'],'nombre'=>$course['nombre'],'cod'=>$course['cod'],'asignaturas' => $courseSubject];
            }
        }else{
            $ret=false;
        }
        return Inertia::render('Cursos',[
            'cursos'=>$ret,
            'asignaturas' => $subjects
        ]);

    }
    /*
    public function searchById(int $id){
        $curso=DB::select("SELECT * FROM cursos where id=?",[1, $id]);
        return $curso;
    }
    */

     /**
     * Update
     *
     * Takes the data sent from the form and updates a course
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(int $id){
        try{
            $data = request()->validate([
                'nombre' => ['required'],
                'cod' => ['required','max:5', Rule::unique('cursos', 'cod')->ignore($id)],
            ]);
        }catch(Exception $exception){
            dd($exception);
        }
        $course=Curso::find($id);

        //Creamos una instancia que no se guarda en la base de datos
        $newCourse=Curso::make($data);
        //Comprobamos si sus atributos son los mismos
        if(Curso::equals($newCourse,$course)){
            dd("Los datos son iguales");
        }else{
            try{
                $course = Curso::find($id);
                $course->update($data);
                $course->asignaturas()->sync(request()->asignaturas);
                $detachedSubjects = $course->asignaturas()->whereNotIn('asignatura_id', request()->asignaturas)->get();
                Curso_Profesor_Asignatura::where('curso_id', $course->id)
                    ->whereNotIn('asignatura_id', request()->asignaturas)
                    ->delete();
            } catch (\Illuminate\Database\QueryException $exception) {
                // You can check get the details of the error using `errorInfo`:
                $errorInfo = $exception->errorInfo;
                // Return the response to the client..
                echo $errorInfo;
            }
        }
        return redirect('/cursos');
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
            Curso::find($id)->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            echo $errorInfo;
        }
        return redirect('/cursos');
    }

}
