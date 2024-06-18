<?php

namespace App\Http\Controllers;

use App\Models\Asignacion_Cargo;
use App\Models\Curso_Profesor_Asignatura;
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
        if (request()['cargo_id']) {
            $assignment = request()->validate([
                'cargo_id' => ['required'],
                'reduccion' => ['required'],
                'turno' => ['required']]);

        }
        //We validate the data
        $data = request()->validate([
            'nombre' => ['required'],
            'email' => ['required', 'min:5', 'max:50', 'email', Rule::unique('profesores', 'email')],
            'cod' => ['required', 'max:5', Rule::unique('profesores', 'cod')],
            'especialidad' => ['required'],
            'departamento' => ['required']
        ]);
        $data['total_horas'] = 0;

        //With the validated data, we try to create the new teacher
        try {
            $teacher = Profesor::create($data);
        } catch (\Illuminate\Database\QueryException $exception) {
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            echo $errorInfo;
        }

        if (isset($assignment)) {
            $assignment['profesor_id'] = $teacher['id'];
            try {
                Asignacion_Cargo::create($assignment);
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
    public function search()
    {
        //Obtain all the teachers
        $teachers = Profesor::all();
        if (empty($teachers['items'])) {
            $ret = [];
            //Return only what's important
            foreach ($teachers as $teacher) {
                $reduction = Asignacion_Cargo::where('profesor_id', $teacher['id'])->get();
                if (!isset($reduction[0])) {
                    $reduction = 0;
                } else {
                    $reduction = $reduction[0]['reduccion'];
                }
                $totalHours = Curso_Profesor_Asignatura::where('profesor_id', $teacher['id'])->sum('horas') + $reduction;
                if ($assignment = Asignacion_Cargo::query()->where('profesor_id', $teacher['id'])->get()->first()) {
                    $ret[] = ['id' => $teacher['id'], 'nombre' => $teacher['nombre'], 'cod' => $teacher['cod'], 'email' => $teacher['email'], 'especialidad' => $teacher['especialidad'],
                        'cargo_id' => $assignment->cargo_id, 'turno' => $assignment->turno, 'reduccion' => $assignment->reduccion,
                        'departamento' => $teacher['departamento'], 'total_horas' => $totalHours];
                } else {
                    $ret[] = ['id' => $teacher['id'], 'nombre' => $teacher['nombre'], 'cod' => $teacher['cod'], 'email' => $teacher['email'], 'especialidad' => $teacher['especialidad'],
                        'departamento' => $teacher['departamento'], 'total_horas' => $totalHours];
                }
            }
        } else {
            $ret = false;
        }
        return Inertia::render('Profesores', [
            'profesores' => $ret
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
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(int $id)
    {
        try {
            if (request()['cargo_id']) {
                $assignment = request()->validate([
                    'cargo_id' => ['required'],
                    'reduccion' => ['required'],
                    'turno' => ['required']]);

            }
            $data = request()->validate([
                'nombre' => ['required'],
                'cod' => ['required', 'max:5', Rule::unique('profesores', 'cod')->ignore($id)],
                'email' => ['required', 'min:5', 'max:50', Rule::unique('profesores', 'email')->ignore($id)],
                'especialidad' => ['required'],
                'departamento' => ['required']
            ]);
        } catch (Exception $exception) {
            dd($exception);
        }
        $teacher = Profesor::find($id);

        //Creamos una instancia que no se guarda en la base de datos
        $newTeacher = Profesor::make($data);
        //Comprobamos si sus atributos son los mismos
        if (!Profesor::equals($newTeacher, $teacher)) {

            try {
                Profesor::find($id)->update($data);
            } catch (\Illuminate\Database\QueryException $exception) {
                // You can check get the details of the error using `errorInfo`:
                $errorInfo = $exception->errorInfo;
                // Return the response to the client..
                echo $errorInfo;
            }
        }

        if (isset($assignment)) {

            if (!$asignacion = Asignacion_Cargo::where('profesor_id', $id)->get()->first()) {
                $assignment['profesor_id'] = $id;
                try {
                    Asignacion_Cargo::create($assignment);
                } catch (\Illuminate\Database\QueryException $exception) {
                    dd("error");
                }
            } else {
                $assignment['profesor_id'] = $id;
                //dd($assignment);
                //$newAssignment = Asignacion_Cargo::make($assignment);
                try {
                    Asignacion_Cargo::query()->where('profesor_id', $id)->get()->first()->update($assignment);
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
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(int $id)
    {
        try {
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
