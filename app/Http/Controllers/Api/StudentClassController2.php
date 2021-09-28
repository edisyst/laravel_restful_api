<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentClassController2 extends Controller
{
    public function index(): View
    {
        $studentClasss = StudentClass::all();

        return view('studentClasss.index', compact('studentClasss'));
    }


    public function create(): View
    {
        return view('studentClasss.create');
    }


    public function store(Request $request): RedirectResponse
    {
        StudentClass::create($request->validated());

        return redirect()->route('studentClasss.index');
    }


    public function show(StudentClass $studentClass): View
    {
        return view('studentClasss.show', compact('studentClass'));
    }


    public function edit(StudentClass $studentClass): View
    {
        return view('studentClasss.edit', compact('studentClass'));
    }


    public function update(Request $request, StudentClass $studentClass): RedirectResponse
    {
        $studentClass->update($request->validated());

        return redirect()->route('studentClasss.index');
    }


    public function destroy(StudentClass $studentClass): RedirectResponse
    {
        $studentClass->delete();

        return redirect()->route('studentClasss.index');
    }
}
