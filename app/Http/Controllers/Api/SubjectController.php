<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;


class SubjectController extends Controller
{
    public function index(): JsonResponse
    {
        $subjects = Subject::all();

        return response()->json($subjects);
    }


    public function store(Request $request): JsonResponse
    {
        $rules = array(
            'class_id' => 'required',
            'code' => 'required|max:6',
            'name' => 'required|min:6|max:25',
        );

        $validator = Validator::make($request->all(), $rules);

        if (($validator->fails())) {
//            return $validator->errors();  //DEBUG
            return response()->json($validator->errors(), 401);

        } else {
            $subject = new Subject([
                'name' => $request->name,
                'code' => $request->code,
                'class_id' => $request->class_id,
            ]);
            if ($subject->save()) {
                return response()->json($subject, 201);
            } else {
                return ["Result" => "Operazione fallita"];
            }
        }
    }


    public function show(Subject $subject): JsonResponse
    {
        return response()->json($subject); // forse basta questo
    }


    public function update(Request $request, Subject $subject): JsonResponse
    {
        $rules = array(
            'class_id' => 'required',
            'code' => 'required|max:6',
            'name' => 'required|min:6|max:25',
        );

        $validator = Validator::make($request->all(), $rules);

        if (($validator->fails())) {
            return response()->json($validator->errors(), 401);

        } else {
            $subject->update([
                'name' => $request->name,
                'code' => $request->code,
                'class_id' => $request->class_id,
            ]);
            if ($subject->save()) {
                return response()->json($subject, 202);
            } else {
                return ["Result" => "Operazione fallita"];
            }
        }
    }


    public function destroy(Subject $subject): JsonResponse
    {
        $subject->delete();

        return response()->json('Deleted successfully');
    }
}
