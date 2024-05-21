<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\AlertForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AgentDashboardController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the authenticated user's ID
          $userId = auth()->id();

        $agentSlipping = Result::select('status')->where('status','=',1)->where('agent_name','=',$userId)->count();

        $agentPending = Result::select('status')->where('status','=',2)->where('agent_name','=',$userId)->count();

        $agentCompleted = Result::select('status')->where('status','=',3)->where('agent_name','=',$userId)->count();

        $agentTotal = Result::select('agent_name')->where('agent_name','=',$userId)->count();

        $agentAlertSlipping = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.agent_name')
                                   ->join('results','results.id','=','alert_forms.results_id')
                                   ->where('auto_status','=',1)
                                   ->where('alert_forms.agent_name','=',$userId)
                                   ->count();

        $agentAlertPending = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.agent_name')
                                   ->join('results','results.id','=','alert_forms.results_id')
                                   ->where('auto_status','=',2)
                                   ->where('alert_forms.agent_name','=',$userId)
                                   ->count();

        $agentAlertCompleted = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.agent_name')
                                     ->join('results','results.id','=','alert_forms.results_id')
                                     ->where('auto_status','=',3)
                                     ->where('alert_forms.agent_name','=',$userId)
                                     ->count();

        $agentAlertTotal = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.agent_name')
                                     ->join('results','results.id','=','alert_forms.results_id')
                                     ->where('alert_forms.agent_name','=',$userId)
                                     ->count();


        $results = DB::table('results')->where('agent_name','=',$userId)->get();

       // Group the data by week/month and calculate the average of the "final_results" column
        $weeklyResults = $results->groupBy(function($result) {
             return \Carbon\Carbon::parse($result->created_at)->startOfWeek();
             })->map(function($group) {
        return $group->avg('final_results');
         });

       $monthlyResults = $results->groupBy(function($result) {
        return \Carbon\Carbon::parse($result->created_at)->startOfMonth();
       })->map(function($group) {
        return $group->avg('final_results');
       });

        // Create the data arrays for the graph
        $weeklyData = $weeklyResults->values();
        $weeklyLabels = $weeklyResults->keys()->map(function($date) {
        return Carbon::parse($date)->format('M d');
       })->values();

       $monthlyData = $monthlyResults->values();
       $monthlyLabels = $monthlyResults->keys()->map(function($date) {
        return Carbon::parse($date)->format('M Y');
        })->values();


        $data['agentSlipping'] = $agentSlipping;
        $data['agentPending'] = $agentPending;
        $data['agentCompleted'] = $agentCompleted;
        $data['agentTotal'] = $agentTotal;
        $data['agentAlertSlipping'] = $agentAlertSlipping;
        $data['agentAlertPending'] = $agentAlertPending;
        $data['agentAlertCompleted'] = $agentAlertCompleted;
        $data['agentAlertTotal'] = $agentAlertTotal;

        $data['weeklyData'] = $weeklyData;
        $data['weeklyLabels'] = $weeklyLabels;
        $data['monthlyData'] = $monthlyData;
        $data['monthlyLabels'] = $monthlyLabels;


        return view('agent/agentdashboard')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
