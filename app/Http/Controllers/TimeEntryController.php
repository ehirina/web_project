<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Validator;
use App\Project;
use App\Report;

class TimeEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('reports.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();

        return view('reports.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->validate($request, [
        'message.note'          => 'max:500',
        'message.id_project'    => 'required|exists:projects,id',
        'message.id_user'       => 'required|exists:users,id',
        'message.ore'           => 'required',
        'message.date'          => 'date|before:tomorrow'
      ]);

        // Log::info($request);
        $report = new Report();
        $report->id_project = $request->input('message.id_project');
        $report->id_user    = $request->input('message.id_user');
        $report->ore        = $request->input('message.ore');
        $report->note       = $request->input('message.note');
        $report->date       = $request->input('message.date');
        $report->save();

        $response  = array(
          'status' => 'success',
          'msg'    => $request->note,
      );
       // return redirect('/');
      //return response()->json($response);

        return json_encode( ['message' => 'ok'] );
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
        //
    }
}
