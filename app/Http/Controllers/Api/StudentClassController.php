<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{

    public function index(): JsonResponse
    {
        $classes = StudentClass::all();

        return response()->json($classes);
    }


    public function store(Request $request)//: JsonResponse
    {
//        $studentClass = StudentClass::create($request->validated());
        $studentClass = StudentClass::create($request->validate([
            'name'=> 'required|unique:student_classes|max:30'
        ]));

        return response()->json($studentClass);
//        return response('Inserted successfully');
    }


    public function show(StudentClass $studentClass)
    {
        //
    }


    public function update(Request $request, StudentClass $studentClass)
    {
        //
    }


    public function destroy(StudentClass $studentClass)
    {
        //
    }
}
