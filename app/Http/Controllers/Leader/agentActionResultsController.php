<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use RealRashid\SweetAlert\Facades\Alert;
use App\Jobs\AuditJob;

class agentActionResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Respons
     */
    public function index()
    {
        $qa_results = [];

        $ticketStatus= TicketStatus::all();

        $supervisorRole_id = Role::select('roles.id',)->where('name', '=', 'team-leader')->first();

        // Get the authenticated user's ID
         $userId = auth()->id();

        $userlogged = User::select('users.name','users.id',)->where('users.id','=',$userId)->first();

        $supervisorlogged = Role::select('roles.id',)
                                     ->join('model_has_roles','model_has_roles.role_id','=','roles.id')
                                     ->where('name', '=', 'team-leader')
                                     ->where('model_has_roles.role_id','=',$userId )
                                     ->first();

        $agentlogged = Role::select('roles.id',)
                                ->join('model_has_roles','model_has_roles.role_id','=','roles.id')
                               ->where('name', '=', 'Agent')
                               ->where('model_has_roles.role_id','=',$userId )
                               ->first();

        $supervisors= User::select('users.name','users.id','model_has_roles.role_id')
                           ->join('model_has_roles','model_id','=','users.id')
                           ->join('roles','roles.id','=','model_has_roles.role_id')
                           ->where('model_has_roles.role_id','=',$supervisorRole_id->id)
                            ->get();

         $data['ticketStatus']=$ticketStatus;
         $data['qa_results']=$qa_results;
         $data['supervisors']=$supervisors;
         $data['$userId']=$userId;
         $data['supervisorlogged']=$supervisorlogged;
         $data['agentlogged']=$agentlogged;
         $data['userlogged']=$userlogged;

        return view('team_leader/agents_actions_results')->with($data);
    }
    /**
     * create a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // Get the authenticated user's ID
        $userId = auth()->id();

        $userlogged = User::select('users.name','users.id',)->where('users.id','=',$userId)->first();

        $input= $request->all();

         $supervisor = $request->input('supervisor');
         $status = $request->input('status');

         $start_end_date = explode(' - ', $request->input('created_at'));
         $start_date = $start_end_date[0];
         $end_date = $start_end_date[1];


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

        $supervisorRole_id = Role::select('roles.id',)->where('name', '=', 'team-leader')->first();

        $supervisors= User::select('users.name','users.id','model_has_roles.role_id','user_categories.category_id','categories.category_name')
                           ->join('model_has_roles','model_id','=','users.id')
                           ->join('roles','roles.id','=','model_has_roles.role_id')
                           ->join('user_categories','user_categories.user_id','=','users.id')
                           ->join('categories','categories.id','=','user_categories.category_id')
                          ->where('model_has_roles.role_id','=',$supervisorRole_id->id)
                            ->get();

        $ticketStatus= TicketStatus::all();

        $data['ticketStatus']=$ticketStatus;
        $data['supervisors']=$supervisors;
        $data['qa_results']=$qa_results;
        $data['userlogged']=$userlogged;

        return view('team_leader/agents_actions_results')->with($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

          // Find the result and join the question_results and fiber_welcome_questions tables
    $audit_agent =Result::find($id)->join('question_results','question_results.results','=','results.id')
                                   ->join('fiber_welcome_questions','fiber_welcome_questions.id','=','question_results.question_no')
                                ->select('question_results.results','question_results.marks','question_results.question_no','question_results.created_by',
             'results.id','results.supervisor','results.agent_name','results.quality_analysts',
             'results.date_recorded','results.category','results.customer_account','results.final_results',
             'results.recording_id','results.final_results','results.qa_call_category','results.qa_call_nature',
             'results.agent_call_category','results.agent_call_nature','results.general_issue','results.specific_issue','results.supervisor_comment',
             'results.feedback_from_qc','results.results','question_results.question_no','fiber_welcome_questions.question','results.agent_comment',
             'fiber_welcome_questions.number',
             'fiber_welcome_questions.id as r_id','fiber_welcome_questions.yes','fiber_welcome_questions.no')
                        ->where('question_results.results','=',$id)
               ->get();

           foreach($audit_agent as $key => $value){

            $agentName = User::where('id','=', $value['agent_name'])->first();
            $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

            $SupervisorName = User::where('id','=', $value['supervisor'])->first();
            $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

            $qualityName = User::where('id','=', $value['quality_analysts'])->first();
            $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

           }


           // Store the audit_agent in the $data array
                   $data['audit_agent'] = $audit_agent;

        return view('team_leader/teamleader_view_results')->with($data);
    }

            /**
     * qualityreport a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function qualityreport(Request $request)
    {

        // Get the authenticated user's ID
        $userId = auth()->id();

        $userlogged = User::select('users.name','users.id',)->where('users.id','=',$userId)->first();

        $input= $request->all();

         $agent = $request->input('agent');
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
                                     ->where('results.agent_name','=',$agent)
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

           // Find the result and join the question_results and fiber_welcome_questions tables
    $tlactions =Result::find($id)->join('question_results','question_results.results','=','results.id')
                                 ->join('fiber_welcome_questions','fiber_welcome_questions.id','=','question_results.question_no')
                               ->select('question_results.results','question_results.marks','question_results.question_no','question_results.created_by','results.id','results.supervisor',
                               'results.agent_name','results.quality_analysts','results.date_recorded','results.category','results.customer_account','results.recording_id','results.final_results',
                               'results.qa_call_category','results.qa_call_nature','results.agent_call_category','results.agent_call_nature','results.general_issue','results.specific_issue',
                               'results.feedback_from_qc','results.results','results.supervisor_comment','results.agent_comment','question_results.question_no','fiber_welcome_questions.question', 'fiber_welcome_questions.number', 'fiber_welcome_questions.id as r_id','fiber_welcome_questions.yes','fiber_welcome_questions.no')
                              ->where('question_results.results','=',$id)
                              ->get();

     $autofail=AlertForm::select('alert_forms.results_id')->get();

     $userId = auth()->id();

     $supervisorlogged = Role::select('roles.id')
                             ->join('model_has_roles', 'model_has_roles.role_id', '=', 'roles.id')
                             ->join('users', 'users.id', '=', 'model_has_roles.model_id')
                             ->where('roles.name', '=', 'team-leader')
                             ->where('users.id', '=', $userId)
                             ->first();

     $agentlogged = Role::select('roles.id')
                       ->join('model_has_roles', 'model_has_roles.role_id', '=', 'roles.id')
                       ->join('users', 'users.id', '=', 'model_has_roles.model_id')
                       ->where('roles.name', '=', 'Agent')
                       ->where('users.id', '=', $userId)
                       ->first();


            // Store the audit_agent in the $data array
           $data['tlactions']=$tlactions;
           $data['autofail']=$autofail;
           $data['$userId']=$userId;
           $data['supervisorlogged']=$supervisorlogged;
           $data['agentlogged']=$agentlogged;

           // Display a success message using the toast function
           toast('Audit Updated successfully','success');

                 //print_pre($data, true);


       // dd($id);

        return view('team_leader/Teamleader_action_results')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $input =$request->all();


       $resultID = $request->input('id');

       // Find the Result record by its ID
        /** @var Result $result */
       $Comments = Result::find($resultID);

       // Check if the supervisor_comment input is set and save it to the supervisor_comment field of the Result record
       if (isset($input['supervisor_comment'])) {
           $Comments->supervisor_comment = $input['supervisor_comment'];
           $Comments->status = '2';
       }

       // Check if the agent_comment input is set and save it to the agent_comment field of the Result record
       if (isset($input['agent_comment'])) {
           $Comments->agent_comment = $input['agent_comment'];
           $Comments->status = '3';
       }

       // Save the updated Result record
       $Comments->save();

       // Dispatch an audit job for the updated Result record
       AuditJob::dispatch($Comments);


       return redirect('team_leader/teamleader_view_results/'.$resultID );
    }


}
