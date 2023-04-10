<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCategory;
use App\Models\Result;
use App\Models\AlertForm;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class teamleaderdashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supervisorId = auth()->id();

        $supervisorCategory = UserCategory::select('category_id')->where('user_id','=',$supervisorId)->first();

      $agentId =User::select('users.id')
                            ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                            ->join('roles','roles.id','=','model_has_roles.role_id')
                            ->join('user_categories','user_categories.user_id','=','users.id')
                           // ->where('user_categories.category_id','=',$supervisorCategory)
                            ->where('roles.name','=', 'agent')
                            ->first();

       $agents =UserCategory::select('user_id','category_id')->where('user_id','=',$agentId)->orwhere('category_id','=',$supervisorCategory->category_id)->first();

       $agentSlipping = Result::select('agent_name')->where('status','=',1)->where('category','=',$supervisorCategory->category_id)->count();

       $agentPending = Result::select('agent_name')->where('status','=',2)->where('category','=',$supervisorCategory->category_id)->count();

       $agentCompleted = Result::select('agent_name')->where('status','=',3)->where('category','=',$supervisorCategory->category_id)->count();

       $agentTotal = Result::select('agent_name')->where('category','=',$supervisorCategory->category_id)->count();


          $agentAlertSlipping = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.agent_name')
                                   ->join('results','results.id','=','alert_forms.results_id')
                                   ->where('auto_status','=',1)
                                   ->where('alert_forms.supervisor_name','=',$supervisorId)
                                   ->count();

        $agentAlertPending = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.agent_name')
                                   ->join('results','results.id','=','alert_forms.results_id')
                                   ->where('auto_status','=',2)
                                   ->where('alert_forms.supervisor_name','=',$supervisorId)
                                   ->count();

        $agentAlertCompleted = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.agent_name')
                                     ->join('results','results.id','=','alert_forms.results_id')
                                     ->where('auto_status','=',3)
                                     ->where('alert_forms.supervisor_name','=',$supervisorId)
                                     ->count();

        $agentAlertTotal = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.agent_name')
                                     ->join('results','results.id','=','alert_forms.results_id')
                                     ->where('alert_forms.supervisor_name','=',$supervisorId)
                                     ->count();

                                     $results = DB::table('results')->where('category','=',$supervisorCategory->category_id)->get();

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

        // print_pre( $agentAlertSlipping,true);

        $data['weeklyData'] = $weeklyData;
        $data['weeklyLabels'] = $weeklyLabels;
        $data['monthlyData'] = $monthlyData;
        $data['monthlyLabels'] = $monthlyLabels;


        return view('team_leader/TeamleaderDashboard')->with($data);
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
