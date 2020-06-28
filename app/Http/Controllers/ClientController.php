<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

use Carbon\Carbon;
use App\Client;
use App\Project;

class ClientController extends Controller
{
          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Hsttp\Response
     */
          public function index()
          {
            $clients = Client::all();
            return view('clients.index', compact('clients'));
        }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function create()
        {
            return view('clients.create');
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
                'ragione_sociale'   => 'required|max:255',
                'nome_referente'    => 'max:255',
                'cognome_referente' => 'max:255',
                'email'             => 'required|email',
                'ssid'              => 'required|max:7',
                'pec'               => 'required|email',
                'partita_iva'       => 'required|size:11',
            ]);

            if ($validator->fails()) {
                return redirect('clients/create')
                ->withErrors($validator)
                ->withInput();
            }

            $client = new Client;
            $client->ragione_sociale   = $request->input('ragione_sociale');
            $client->nome_referente    = $request->input('nome_referente');
            $client->cognome_referente = $request->input('cognome_referente');
            $client->email             = $request->input('email');
            $client->ssid              = $request->input('ssid');
            $client->pec               = $request->input('pec');
            $client->partita_iva       = $request->input('partita_iva');
            $client->save();

        //Client::create($input);

            return redirect('/clients');
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
        

            $elemento = Client::find($id);
            $projects = DB::table('projects')
                    ->select('projects.name as name', 'projects.id as id')
                    ->where('id_cliente', '=', $id)
                    ->get();

            $total_time_spent = DB::table('reports')
                    ->join('projects', 'reports.id_project', '=', 'projects.id')
                    ->where('projects.id_cliente', '=', $id)->whereBetween('date', array($date_from, $date_to))
                    ->sum('ore');
             $expenses = DB::table('reports')
                    ->join('projects', 'reports.id_project', '=', 'projects.id')
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->where('projects.id_cliente', '=', $id)->whereBetween('date', array($date_from, $date_to))
                     ->sum(\DB::raw('assignments.internal_rate * ore'));
             $income = DB::table('reports')
                    ->join('projects', 'reports.id_project', '=', 'projects.id')
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->where('projects.id_cliente', '=', $id)->whereBetween('date', array($date_from, $date_to))
                     ->sum(\DB::raw('assignments.external_rate * ore'));
                     

            return view('clients.show', compact('elemento', 'projects', 'total_time_spent', 'income', 'expenses'));
        }

        public function show_detailed_info(Request $request){
        $msg  = $request->query('message');
        $date_from = $msg['date_from'];
        $date_to    = $msg['date_to'];
        $client_id = $msg['client_id'];

       
        $total_time_spent = DB::table('reports')
                    ->join('projects', 'reports.id_project', '=', 'projects.id')
                    ->where('projects.id_cliente', '=', $client_id)->whereBetween('date', array($date_from, $date_to))
                    ->sum('ore');
        $total_personell_expenses = DB::table('reports')
                    ->join('projects', 'reports.id_project', '=', 'projects.id')
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->where('projects.id_cliente', '=', $client_id)->whereBetween('date', array($date_from, $date_to))
                     ->sum(\DB::raw('assignments.internal_rate * ore'));
        $total_personell_profit = DB::table('reports')
                    ->join('projects', 'reports.id_project', '=', 'projects.id')
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->where('projects.id_cliente', '=', $client_id)->whereBetween('date', array($date_from, $date_to))
                     ->sum(\DB::raw('assignments.external_rate * ore'));

        $to = new Carbon($date_to);
        $to = $to->format('d F Y');
        $from = new Carbon($date_from);
        $from = $from->format('d F Y');
        

     return response()->json(array('total_time_spent'=> $total_time_spent, 'date_from' => $from, 'date_to' => $to, 'income' => $total_personell_profit, 'expenses' => $total_personell_expenses), 200);
        
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function destroy($id)
        {
            $elemento = Client::find($id);
            $elemento->delete();

            return redirect('/clients');
        }
    }
