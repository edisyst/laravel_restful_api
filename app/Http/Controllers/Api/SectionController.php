<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SectionController extends Controller
{
    public function index(): JsonResponse
    {
        $sections = Section::all();

        return response()->json($sections);
    }



    public function store(Request $request): JsonResponse
    {
        $rules = array(
            'class_id' => 'required',
            'name' => 'required|min:6|max:25',
        );

        $validator = Validator::make($request->all(), $rules);

        if (($validator->fails())) {
            return response()->json($validator->errors(), 401);

        } else {
            $subject = new Section([
                'name' => $request->name,
                'class_id' => $request->class_id,
            ]);
            if ($subject->save()) {
                return response()->json($subject, 201);
            } else {
                return ["Result" => "Operazione fallita"];
            }
        }
    }


    public function show(Section $section): JsonResponse
    {
        return response()->json($section); // forse basta questo
    }


    public function update(Request $request, Section $section): JsonResponse
    {
        $rules = array(
            'class_id' => 'required',
            'name' => 'required|min:6|max:25',
        );

        $validator = Validator::make($request->all(), $rules);

        if (($validator->fails())) {
            return response()->json($validator->errors(), 401);

        } else {
            $section->update([
                'name' => $request->name,
                'class_id' => $request->class_id,
            ]);
            if ($section->save()) {
                return response()->json($section, 202);
            } else {
                return ["Result" => "Operazione fallita"];
            }
        }
    }


    public function destroy(Section $section): JsonResponse
    {
        $section->delete();

        return response()->json('Deleted successfully');
    }
}
