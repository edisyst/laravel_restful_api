<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // MANCA IL MESSAGGIO DI VALIDAZIONE (ES: ERRORE UNIQUE)
        $request->validate([
            'name' => 'required|unique:student_classes|max:30'
        ]);

        $data = array() ;
        $data['name'] = $request->name;

        $studentClass = StudentClass::create($data);

        return response()->json($studentClass);
    }


    public function show($id): JsonResponse
    {
        $show = DB::table('student_classes')->where('id', $id)->first();

        return response()->json($show);
    }


    public function update(Request $request, $id)
    {
        // MANCA IL MESSAGGIO DI VALIDAZIONE (ES: ERRORE UNIQUE)
        $request->validate([
            'name' => 'required|unique:student_classes|max:30'
        ]);

        $update = DB::table('student_classes')->where('id', $id)->first();
        $update->update([
            'name' => $request->name
        ]);

        return response()->json($update);
    }


    public function destroy(StudentClass $studentClass): JsonResponse
    {
        $studentClass->delete();

        return response()->json('Deleted successfully');
    }
}
