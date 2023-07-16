<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use App\Models\assignments;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;


class AssignMentController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return response()
     */
    public function index(): View
    {
        $assignment = assignments::latest()->paginate(5);
        
        return view('assignments.index',compact('assignment'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('assignments.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'file_path' => 'required|mimes:csv,txt,xlx,xls,pdf,doc,docx|max:2048',
        ]);
    
        $input = $request->all();
    
        if ($file_path = $request->file('file_path')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $file_path->getClientOriginalExtension();
            $file_path->move($destinationPath, $profileImage);
            $input['file_path'] = "$profileImage";
        }
      
        assignments::create($input);
       
        return redirect()->route('assignments.index')
                        ->with('success','Product created successfully.');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(assignments $assignment): View
    {
        return view('assignments.show',compact('assignment'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(assignments $assignment): View
    {
        return view('assignments.edit',compact('assignment'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, assignments $assignment): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required'
        ]);
    
        $input = $request->all();
    
        if ($file_path = $request->file('file_path')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $file_path->getClientOriginalExtension();
            $file_path->move($destinationPath, $profileImage);
            $input['file_path'] = "$profileImage";
        }
            
        $assignment->update($input);
      
        return redirect()->route('assignments.index')
                        ->with('success','Product has been updated successfully.');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(assignments $assignment): RedirectResponse
    {
        $assignment->delete();
         
        return redirect()->route('assignments.index')
                        ->with('success','Product has been deleted successfully.');
    }
}
