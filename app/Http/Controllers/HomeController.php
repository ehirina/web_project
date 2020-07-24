<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id       = Auth::id();
        $current_month =  Carbon::now()->format('m');
      
        $total_hours = DB::table('reports')
                        ->where('reports.id_user', '=', $user_id)
                         ->whereMonth('reports.date', $current_month)
                        ->sum('ore');

        $reports = DB::table('reports')
                    ->select('assignments.internal_rate as internal_rate',  
                             'reports.ore as hours')
                    ->join('assignments', 'reports.id_assignment', '=', 'assignments.id')
                    ->where('reports.id_user', '=', $user_id)
                    ->whereMonth('reports.date', $current_month)
                    ->get();
       
        $total_sum = 0;
        foreach ($reports as $report){
            $total_sum = $total_sum + $report->hours*$report->internal_rate;
        }
    
        return view('loggedin', compact('total_hours', 'total_sum'));
    }
}
