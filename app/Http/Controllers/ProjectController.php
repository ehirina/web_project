<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

use App\Project;
use Auth;
use App\Client;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Hsttp\Response
     */
    public function index()
    {
      
        $user_id = Auth::id();
        $projects = DB::table('projects')
                    ->select('projects.name as name', 'projects.id as id', 'projects.description as description')
                    ->join('assignments', 'projects.id', '=', 'assignments.id_project')
                    ->where('assignments.id_user', '=', $user_id)->get();

        return view('projects.index', compact('projects'));
    }

    // Display all projects
     public function indexAll()
    {
        $projects = DB::table('projects')
                    ->select('projects.name as name', 'projects.id as id', 'projects.description as description', 'clients.ragione_sociale as client', 'clients.id as client_id' )
                    ->join('clients', 'projects.id_cliente', '=', 'clients.id')->get();
        return view('projects.adminIndex', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();

        return view('projects.create', compact('clients'));

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
            'name'          => 'required|max:100',
            'description'   => 'max:255',
            'date_start'    => 'date|after:yesterday',
            'date_end'      => 'date|after:date_start|nullable',
            'id_cliente'    => 'required|exists:clients,id',
        ]);

        if ($validator->fails()) {
            return redirect('projects/create')
                ->withErrors($validator)
                ->withInput();
        }

        $project = new Project;
        $project->name        = $request->input('name');
        $project->description = $request->input('description');
        $project->date_start  = $request->input('date_start');
        $project->date_end    = $request->input('date_end');
        $project->id_cliente  = $request->input('id_cliente');
        $project->save();

        return redirect('/allprojects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $date_from = new Carbon('first day of this month');
        $date_to   = new Carbon('last day of this month');
        

        $elemento = Project::find($id);
        $client = Client::find($elemento->id_cliente);
        $team = DB::table('users')
                        ->select('users.name as name', 'users.surname as surname', 'users.id as id', 'assignments.position as position')
                        ->join('assignments', 'users.id', '=', 'assignments.id_user')
                        ->where('assignments.id_project', '=', $id)->get();
        $total_time_spent = DB::table('reports')
                        ->where('id_project', '=', $id)->whereBetween('date', array($date_from, $date_to))
                        ->sum('ore');
        $expenses = DB::table('reports')
                     ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')   
                    ->where('reports.id_project', '=', $id)->whereBetween('date', array($date_from, $date_to))
                    ->sum(\DB::raw('assignments.internal_rate * ore'));
        $income = DB::table('reports')
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->where('reports.id_project', '=', $id)->whereBetween('date', array($date_from, $date_to))
                    ->sum(\DB::raw('assignments.external_rate * ore'));

        return view('projects.show', compact('elemento', 'client', 'team', 'total_time_spent', 'income', 'expenses'));
    }

    public function show_detailed_info(Request $request){
        $msg  = $request->query('message');
        $date_from = $msg['date_from'];
        $date_to    = $msg['date_to'];
        $project_id = $msg['project_id'];

        $total_time_spent = DB::table('reports')
                    ->where('id_project', '=', $project_id)->whereBetween('date', array($date_from, $date_to))
                    ->sum('ore');
        $total_personell_expenses = DB::table('reports')
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->where('reports.id_project', '=', $project_id)->whereBetween('date', array($date_from, $date_to))
                    ->sum(\DB::raw('assignments.internal_rate * ore'));
        $total_personell_profit = DB::table('reports')   
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->where('reports.id_project', '=', $project_id)->whereBetween('date', array($date_from, $date_to))
                    ->sum(\DB::raw('assignments.external_rate * ore'));

        $to = new Carbon($date_to);
        $to = $to->format('d F Y');
        $from = new Carbon($date_from);
        $from = $from->format('d F Y');
        

     return response()->json(array('total_time_spent'=> $total_time_spent, 'date_from' => $from, 'date_to' => $to, 'income' => $total_personell_profit, 'expenses' => $total_personell_expenses), 200);
        
    }

    public function show_user_info($id){  
        $date_from = new Carbon('first day of this month');
        $date_to   = new Carbon('last day of this month');
        $user_id = Auth::id();
        $elemento = Project::find($id);
       
        $reports = DB::table('reports')
                    ->select('reports.id as id', 'assignments.position as position', 
                             'reports.ore as hours', 'reports.note as note', 
                             'reports.date as date')
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->where('reports.id_user', '=', $user_id)
                    ->where('assignments.id_project', '=', $id)->get();
        $ore_totale = DB::table('reports')
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->where('reports.id_user', '=', $user_id)
                    ->where('assignments.id_project', '=', $id)->sum('ore');

        return view('projects.usershow', compact('elemento', 'reports', 'ore_totale'));     
      
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $elemento = Project::find($id);
        $elemento->delete();
        return redirect('/allprojects');
    }
}
