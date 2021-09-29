<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class StudentClassController3 extends Controller
{
//    public function index(): JsonResponse
//    {
//        $studentClasss = StudentClass::all();
//
//        return response()->json($studentClasss);
//    }



//    public function store(Request $request): JsonResponse
//    {
//        $studentClass = StudentClass::create($request->validated());
//
//        return response()->json($studentClass);
//    }


//    public function show(StudentClass $studentClass): JsonResponse
//    {
//        return response()->json($studentClass); // forse basta questo
////        return new EmployeeSingleResource($employee);  // è un JsonResource
//    }


    public function update(Request $request, StudentClass $studentClass): JsonResponse
    {
        $studentClass->update($request->validated());

        return response()->json($studentClass);
    }


//    public function destroy(StudentClass $studentClass): JsonResponse
//    {
//        $studentClass->delete();
//
//        return response()->json('Deleted successfully');
//    }
}
