<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\teachers;

class TeachersController extends Controller
{
    //

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $teachers = teachers::orderBy('id','desc')->paginate(5);
        return view('teachers.index', compact('teachers'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('teachers.create');
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
            'email' => 'required',
            'address' => 'required',
        ]);
        
        teachers::create($request->post());

        return redirect()->route('teachers.index')->with('success','Teacher has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\teacher  $company
    * @return \Illuminate\Http\Response
    */
    public function show(teachers $teacher)
    {
        return view('teachers.show',compact('teacher'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\teacher  $company
    * @return \Illuminate\Http\Response
    */
    public function edit(teachers $teacher)
    {
        return view('teachers.edit',compact('teacher'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\teacher  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, teachers $teacher)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        
        $teacher->fill($request->post())->save();

        return redirect()->route('teachers.index')->with('success','teacher Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\teacher  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy(teachers $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success','Teacher has been deleted successfully');
    }
}
