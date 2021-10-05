<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    public function index(): JsonResponse
    {
        $students = Student::all();

        return response()->json($students);
    }



    public function store(Request $request): JsonResponse
    {
        $rules = array(
            'class_id'   => 'required',
            'section_id' => 'required',
            'name'       => 'required|min:6|max:25',
            'password'   => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if (($validator->fails())) {
            return response()->json($validator->errors(), 401);

        } else {
            $student = new Student([
                'name'       => $request->name,
                'password'   => Hash::make($request->password),
                'class_id'   => $request->class_id,
                'section_id' => $request->section_id,
            ]);
            if ($student->save()) {
                return response()->json($student, 201);
            } else {
                return ["Result" => "Operazione fallita"];
            }
        }
    }


    public function show(Student $student): JsonResponse
    {
        return response()->json($student); // forse basta questo
    }


    public function update(Request $request, Student $student): JsonResponse
    {
        $rules = array(
            'class_id'   => 'required',
            'section_id' => 'required',
            'name'       => 'required|min:6|max:25',
            'password'   => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if (($validator->fails())) {
            return response()->json($validator->errors(), 401);

        } else {
            $student->update([
                'name'       => $request->name,
                'password'   => Hash::make($request->password),
                'class_id'   => $request->class_id,
                'section_id' => $request->section_id,
            ]);
            if ($student->save()) {
                return response()->json($student, 202);
            } else {
                return ["Result" => "Operazione fallita"];
            }
        }
    }


    public function destroy(Student $student): JsonResponse
    {
//        unlink($student->photo); // fare meglio

        $student->delete();

        return response()->json('Deleted successfully');
    }
}
