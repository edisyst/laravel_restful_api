<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class SubjectController extends Controller
{
    public function index(): JsonResponse
    {
        $subjects = Subject::all();

        return response()->json($subjects);
    }


    public function store(Request $request): JsonResponse
    {
        $subject = Subject::create(
            $request->validate([
                'class_id' => 'required',
                'code' => 'required|max:6',
                'name' => 'required|min:6',
            ]));


        if ($subject->save()) {
            return response()->json($subject, 201);
        } else {
            return ["Result" => "Operazione fallita"];
        }

    }


    public function show(Subject $subject): JsonResponse
    {
        return response()->json($subject); // forse basta questo
//        return new EmployeeSingleResource($employee);  // è un JsonResource
    }


    public function update(Request $request, Subject $subject): JsonResponse
    {
        $subject->update($request->validated());

        return response()->json($subject);
    }


    public function destroy(Subject $subject): JsonResponse
    {
        $subject->delete();

        return response()->json('Deleted successfully');
    }
}
