<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

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
        if (Auth::user()->hasRole('administrator')){
            $projects = Project::all();
        }else {
            $user_id = Auth::id();
            $projects = DB::table('projects')
                        ->select('projects.name as name', 'projects.id as id', 'projects.description as description')
                        ->join('assignments', 'projects.id', '=', 'assignments.id_project')
                        ->where('assignments.id_user', '=', $user_id)->get();

        }
        return view('projects.index', compact('projects'));
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

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $elemento = Project::find($id);
        $client = Client::find($elemento->id_cliente);
        $team = DB::table('users')
                        ->select('users.name as name', 'users.surname as surname', 'users.id as id')
                        ->join('assignments', 'users.id', '=', 'assignments.id_user')
                        ->where('assignments.id_project', '=', $id)->get();
        $total_time_spent = DB::table('time_entry')
                        ->where('id_project', '=', $id)
                        ->sum('ore');

        return view('projects.show', compact('elemento', 'client', 'team', 'total_time_spent'));
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
    }
}
