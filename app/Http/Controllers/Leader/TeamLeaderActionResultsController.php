<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\AlertForm;
use App\Models\Result;
use App\Models\TicketStatus;
use App\Models\Permission;
use App\Models\Positions;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Categories;
use App\Models\IssueGeneral;
use App\Models\CallTracker;
use App\Models\SubCallTracker;
use App\Models\Summary;
use App\Models\LiveCalls;
use App\Models\LiveCalls_results;
use App\Models\GapSummaries;
use App\Models\VoCSummaries;
use App\Models\FiberWelcomeQuestion;
use App\Models\User;
use Datatables;
use Carbon\Carbon;
use App\Models\Coaching;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Jobs\AuditJob;

class TeamLeaderActionResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $WelcomeCategory = FiberWelcomeQuestion::all()->toArray();
    
        return view('team_leader/Teamleader_action_results',compact('WelcomeCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = Categories::select('Categories.id','Categories.category_name')->get();

        $agentRole_id = Role::select('roles.id',)->where('name', '=', 'Agent')->first();

        $user_id = auth()->user()->id;

        $userlogged = User::select('users.name','users.id',)->where('users.id','=',$user_id)->first();

        $supervisorlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'team-leader')->first();

        $agentlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'Agent')->first();

        $qualitylogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'quality-analyst')->first();

        $trainierlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'trainer')->first();

        $agents = User::select('users.name','users.id','model_has_roles.role_id')
                        ->join('model_has_roles','model_id','=','users.id')
                       ->where('model_has_roles.role_id','=',$agentRole_id->id)
                        ->get();

        $input = $request->all();

        $quality = $request->input('quality');

      //  $categoryname = $request->input('category');

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];


        $coachingview = Coaching::Select('coachings.id','coachings.agent','coachings.record_id','coachings.supervisor','coachings.quality_analyst','coachings.scores','coachings.results_id',
                                       'coachings.date_coaching','coachings.scores', 'coachings.coaching_status','coachings.areas_of_strength','coachings.pervious_actions','coachings.current_areas_improvement','coachings.action_points_taken','coachings.agent_signature','coachings.agent_date_sign','coachings.supervisor_signature','coachings.supervisor_date_sign','coachings.quality_analyst_signature','coachings.quality_analyst_date_sign','coachings.created_at','user_categories.category_id')
                                ->join('user_categories','user_categories.user_id','=','coachings.agent')
                                ->where('coachings.quality_analyst','=',$quality )
                              //  ->where('user_categories.category_id','=',$categoryname)
                                //->where('coachings.results_id','=',$results_id)
                                ->where('coachings.created_at','>=',$start_date)
                                ->where('coachings.created_at','<=',$end_date)
                               ->get();

        foreach($coachingview as $key => $value){

                                $agentName = User::where('id','=', $value['agent'])->first();
                                $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                                $SupervisorName = User::where('id','=', $value['supervisor'])->first();
                                $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                                $qualityName = User::where('id','=', $value['quality_analyst'])->first();
                                $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

                            }

                            $data['category']  = $category;
                            $data['coachingview']  = $coachingview;
                            $data['agents']  = $agents;
                            $data['user_id']  = $user_id;
                            $data['supervisorlogged']  = $supervisorlogged;
                            $data['agentlogged']  = $agentlogged;
                            $data['qualitylogged']  = $qualitylogged;
                            $data['trainierlogged']  = $trainierlogged;
                            $data['userlogged']  = $userlogged;

                        
                            return view('coaching_forms/view')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

             // Get the authenticated user's ID
             $userId = auth()->id();

             $userlogged = User::select('users.name','users.id',)->where('users.id','=',$userId)->first();

             $input= $request->all();

              $quality = $request->input('quality');
              $status = $request->input('status');

              $start_end_date = explode(' - ', $request->input('created_at'));
              $start_date = $start_end_date[0];
              $end_date = $start_end_date[1];;

             $qa_results = Result::select('results.id','results.agent_name','results.supervisor','results.quality_analysts','results.date_recorded','results.customer_account',
                                          'results.recording_id','results.supervisor_comment','results.final_results','results.status','results.category','results.created_at',
                                           'users.country',
                                           'users.services',
                                          'categories.category_name',
                                         'services.service_name',
                                          'countries.country_name',
                                          )
                                         // ->join('user_categories','user_categories.category_id','=','results.category')
                                         ->join('users','users.id','=','results.agent_name')
                                         ->join('categories','categories.id','=','results.category')
                                         ->join('services','services.id','=','users.services')
                                         ->join('countries','countries.id','=','users.country')
                                          ->where('results.quality_analysts','=',$quality)
                                          ->where('results.status','=',$status)
                                          ->where('results.date_recorded','>=',$start_date)
                                          ->where('results.date_recorded','<=',$end_date)
                                          ->get();

             foreach($qa_results as $key => $value){

                 $value['autofails'] = AlertForm::select('alert_forms.id','alert_forms.results_id')
                 ->where('results_id','=',$value['id'] )
                 ->get();

                 $agentName = User::where('id','=', $value['agent_name'])->first();
                 $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                 $SupervisorName = User::where('id','=', $value['supervisor'])->first();
                 $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                 $qualityName = User::where('id','=', $value['quality_analysts'])->first();
                 $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

             }

             $ticketStatus= TicketStatus::all();

             $data['ticketStatus']=$ticketStatus;
             $data['qa_results']=$qa_results;
             $data['userlogged']=$userlogged;

             return view('team_leader/agents_actions_results')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
                 // Get the authenticated user's ID
                 $userId = auth()->id();

                 $userlogged = User::select('users.name','users.id',)->where('users.id','=',$userId)->first();

                 $input= $request->all();

                 // dd(   $input);

                  $supervisor = $request->input('supervisor');
                  $status = $request->input('status');

                  $start_end_date = explode(' - ', $request->input('created_at'));
                  $start_date = $start_end_date[0];
                  $end_date = $start_end_date[1];;

                 $qa_results = Result::select('results.id','results.agent_name','results.supervisor','results.quality_analysts','results.date_recorded','results.customer_account','results.recording_id',
                                             'results.supervisor_comment','results.final_results','results.status','results.category','users.country','users.services','categories.category_name','services.service_name','countries.country_name','results.created_at',)
                                              ->join('user_categories','user_categories.category_id','=','results.category')
                                              ->join('users','users.id','=','user_categories.user_id')
                                              ->join('categories','categories.id','=','results.category')
                                              ->join('services','services.id','=','users.services')
                                              ->join('countries','countries.id','=','users.country')
                                              ->where('results.supervisor','=',$supervisor)
                                              ->where('results.status','=',$status)
                                              ->where('results.date_recorded','>=',$start_date)
                                              ->where('results.date_recorded','<=',$end_date)
                                              ->get();

                 foreach($qa_results as $key => $value){

                     $value['autofails'] = AlertForm::select('alert_forms.id','alert_forms.results_id')
                     ->where('results_id','=',$value['id'] )
                     ->get();

                     $agentName = User::where('id','=', $value['agent_name'])->first();
                     $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                     $SupervisorName = User::where('id','=', $value['supervisor'])->first();
                     $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                     $qualityName = User::where('id','=', $value['quality_analysts'])->first();
                     $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

                 }

                 $ticketStatus= TicketStatus::all();

                 $data['ticketStatus']=$ticketStatus;
                 $data['qa_results']=$qa_results;
                 $data['userlogged']=$userlogged;

                 return view('team_leader/agents_actions_results')->with($data);
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
