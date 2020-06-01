<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Project;
use App\User;
use App\Assignment;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $projects = Project::all();
        return view('assignments.create', compact('projects','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $projects = Project::all();
        return view('assignments.create', compact('projects','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'internal_rate'   => 'numeric',
            'external_rate'   => 'numeric',
            'date_start'      => 'required|date|after:yesterday',
            'date_end'        => 'date|after:date_start|nullable',
            'id_project'      => 'required|exists:projects,id',
            'id_user'         => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect('assignments/create')
                ->withErrors($validator)
                ->withInput();
            }
        
        $assignment = new Assignment;
        $assignment->internal_rate = $request->input('internal_rate');
        $assignment->external_rate = $request->input('external_rate');
        $assignment->date_start    = $request->input('date_start');
        $assignment->date_end      = $request->input('date_end');
        $assignment->id_project    = $request->input('id_project');
        $assignment->id_user       = $request->input('id_user');
        $assignment->save();

        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $elemento = Assignment::find($id);
        $elemento->delete();
    }
}
