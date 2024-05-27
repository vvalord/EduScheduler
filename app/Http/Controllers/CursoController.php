<?php

namespace App\Http\Controllers;

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
         Curso::create($datos);
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
        //Obtain all the courses
        $cursos = Curso::all();
        $ret=[];
        //Return only what's important
        foreach($cursos as $curso){
            $ret[]=['id'=>$curso['id'],'nombre'=>$curso['nombre'],'cod'=>$curso['cod']];
        }
        return Inertia::render('Cursos',[
            'cursos'=>$ret
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
        $datos = request()->validate([
            'cod' => ['required','min:3','max:5', Rule::unique('cursos', 'cod')]
        ]);
        $curso=Curso::find($id);
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
