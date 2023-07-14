<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\students;

class StudentsController extends Controller
{
    //
    //

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $students = students::orderBy('id','desc')->paginate(5);
        return view('students.index', compact('students'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('students.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contacts' => 'required',
            'address' => 'required',
        ]);
        
        students::create($request->post());

        return redirect()->route('students.index')->with('success','Student has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\student  $company
    * @return \Illuminate\Http\Response
    */
    public function show(students $student)
    {
        return view('students.show',compact('student'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\student  $company
    * @return \Illuminate\Http\Response
    */
    public function edit(students $student)
    {
        return view('students.edit',compact('student'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\student  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, students $student)
    {
        $request->validate([
            'name' => 'required',
            'contacts' => 'required',
            'address' => 'required',
        ]);
        
        $student->fill($request->post())->save();

        return redirect()->route('students.index')->with('success','student Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\student  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy(students $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','student has been deleted successfully');
    }
}
