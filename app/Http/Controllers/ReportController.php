<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Validator;
use App\Project;
use App\Report;
use App\Assignment;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $user_id = Auth::id();
        $projects = DB::table('projects')
                    ->select('projects.name as name', 'projects.id as id', 'projects.description as description')
                    ->join('assignments', 'projects.id', '=', 'assignments.id_project')
                    ->where('assignments.id_user', '=', $user_id)->get();

        $reports = DB::table('reports')
                    ->select('reports.id as id', 'assignments.position as position', 
                             'projects.name as project_name', 'projects.id as project_id', 
                             'reports.ore as hours', 'reports.note as note', 
                             'reports.date as date')
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->join('projects', 'reports.id_project', '=', 'projects.id')
                    ->where('reports.id_user', '=', $user_id)->get();

        return view('reports.index', compact('projects', 'reports'));
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

        
        $assignment = DB::table('assignments')->select('id')->where([
            ['id_user', $request->input('message.id_user')],
            ['id_project', $request->input('message.id_project')]
        ])->get();

        $report = new Report();
        $report->id_project       = $request->input('message.id_project');
        $report->id_user          = $request->input('message.id_user');
        $report->id_assignment    = $assignment[0]->id;
        $report->ore              = $request->input('message.ore');
        $report->note             = $request->input('message.note');
        $report->date             = $request->input('message.date');
        $report->save();

        $response  = array(
          'status' => 'success',
          'msg'    => $request->note,
      );
    
        return json_encode( ['message' => 'ok'] );
    }

    public function show_reports_period(Request $request){
       // $msg  = $request->query('message');
        $date_from_def = new Carbon('first day of this month');
        $date_to_def   = new Carbon('last day of this month');
       
        $date_from = $request->query('date_from', $date_from_def);
        $date_to   = $request->query('date_to', $date_to_def);
        $user_id = Auth::id();
        $projects = DB::table('projects')
                    ->select('projects.name as name', 'projects.id as id', 'projects.description as description')
                    ->join('assignments', 'projects.id', '=', 'assignments.id_project')
                    ->where('assignments.id_user', '=', $user_id)->get();


        $reports = DB::table('reports')
                    ->select('reports.id as id', 'assignments.position as position', 
                             'projects.name as project_name', 'projects.id as project_id', 
                             'reports.ore as hours', 'reports.note as note', 
                             'reports.date as date')
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->join('projects', 'reports.id_project', '=', 'projects.id')
                    ->where('reports.id_user', '=', $user_id)
                    ->whereBetween('date', array($date_from, $date_to))
                    ->get();

        $to = new Carbon($date_to);
        $to = $to->format('d F Y');
        $from = new Carbon($date_from);
        $from = $from->format('d F Y');

         return view('reports.index', compact('reports', 'projects', 'from', 'to'));

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

        $report = Report::find($id);
        $projects = Project::all();
        return view('reports.edit', compact('report', 'projects'));
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
         $input = $request->all();

        $report = Report::find($id);
        //$expense = Expense::find($id);
        $report->update($input);

        return redirect("/reports");
       }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $elemento = Report::find($id);
        $elemento->delete();
        return redirect('/reports');
    }
}
