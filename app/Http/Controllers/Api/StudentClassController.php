<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentClassController extends Controller
{


    /*
    rating
    classification
    group
    grouping
    set
    division
    variety
    genre
    species
    genus
    generation
    denomination
    cast
    order
    level
    group
    grouping
    set
    caste
    position
    hierarchy
    */






    public function index(): JsonResponse
    {
        $classes = StudentClass::all();

        return response()->json($classes);
    }




    public function store(Request $request)//: JsonResponse
    {
        $rules = array(
            'name' => 'required|unique:student_classes|max:30'
        );

        $errors = array(
            'name.required' => 'Il nome è obbligatorio',
//            'name.unique' => 'Il nome deve essere univoco',
        );

        $validator = Validator::make($request->all(), $rules, $errors);

        if (($validator->fails())) {
//            return $validator->errors();  //DEBUG
            return response()->json($validator->errors(), 401);

        } else {
            $class = new StudentClass([
                'name' => $request->name,
            ]);
            if ($class->save()) {
                return response()->json($class, 201);
            } else {
                return ["Result" => "Operazione fallita"];
            }
        }
    }




    public function show(StudentClass $class) // : JsonResponse
    {
//        return StudentClass::find($class)->first();
//        dd($class);

        if ( $class === null )  // non entra in questo controllo
        {
            return response()->json("Elemento non trovato", 414);
        }
        return response()->json($class, 200);
    }




    public function update(Request $request, StudentClass $class)
    {
        //PARADOSSALMENTE ORA MI DA' ERRORE SE REINVIO LO STESSO VALORE DI name
        //DEVO CERCARE DI FARE IL CHECK SULL'ESISTENZA DEL RECORD
        $rules = array(
            'name' => 'required|unique:student_classes|max:30'
        );

        $errors = array(
            'name.required' => 'Il nome è obbligatorio',
//            'name.unique' => 'Il nome deve essere univoco',
        );

        $validator = Validator::make($request->all(), $rules, $errors);

        if (($validator->fails())) {
//            return $validator->errors();  //DEBUG
            return response()->json($validator->errors(), 401);

        } else {
            $class->update([
                'name' => $request->name,
            ]);
            if ($class->save()) {
                return response()->json($class, 202);
            } else {
                return ["Result" => "Operazione fallita"];
            }
        }
    }


    public function destroy(StudentClass $class): JsonResponse
    {
        //DEVO CERCARE DI FARE IL CHECK SULL'ESISTENZA DEL RECORD
        $class->delete();

        return response()->json('Deleted successfully',244);
        //se metto come status=204 non mi scrive il messaggio
    }
}

