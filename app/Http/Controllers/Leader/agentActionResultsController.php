<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\AlertForm;
use App\Models\Result;
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
        $qa_results = Result::select('results.id','results.agent_name','results.supervisor','results.quality_analysts','results.date_recorded','results.customer_account','results.recording_id',
                                     'results.final_results','results.status','results.category','users.country','users.services','categories.category_name','services.service_name','countries.country_name','user_categories.user_id')
                                     ->join('user_categories','user_categories.category_id','=','results.category')
                                     ->join('users','users.id','=','user_categories.user_id')
                                     ->join('categories','categories.id','=','results.category')
                                     ->join('services','services.id','=','users.services')
                                     ->join('countries','countries.id','=','users.country')
                                     ->get();

        // print_pre($qa_results , true);
        // exit;
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


         $data['qa_results']=$qa_results;

        //  $data['autofail']=$autofail;

         //dd($value);



        return view('team_leader/agents_actions_results')->with($data);
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
    public function search(Request $request)
    {

        $input= $request->all();

         //print_pre([$input] , true);

         $supervisor = $request->input('supervisor');

         $status = $request->input('status');

         $start_end_date = explode(' - ', $request->input('created_at'));
         $start_date = $start_end_date[0];
         $end_date = $start_end_date[1];;



        $qa_results = Result::select('results.id','results.agent_name','results.supervisor','results.quality_analysts','results.date_recorded','results.customer_account','results.recording_id',
                                     'results.final_results','results.status','results.category','users.country','users.services','categories.category_name','services.service_name','countries.country_name',)
                                     ->join('users','users.category','=','results.category')
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
        //print_pre([$qa_results] , true);

         $data['qa_results']=$qa_results;


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

           // Store the audit_agent in the $data array
                   $data['audit_agent'] = $audit_agent;

        return view('team_leader/teamleader_view_results')->with($data);
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
                               'results.feedback_from_qc','results.results','question_results.question_no','fiber_welcome_questions.question', 'fiber_welcome_questions.number', 'fiber_welcome_questions.id as r_id','fiber_welcome_questions.yes','fiber_welcome_questions.no')
                              ->where('question_results.results','=',$id)
                              ->get();

     $autofail=AlertForm::select('alert_forms.results_id')->get();
            // Store the audit_agent in the $data array
           $data['tlactions']=$tlactions;
           $data['autofail']=$autofail;

           // Display a success message using the toast function
           toast('Audit Updated successfully','success');

                    //  print_pre($autofail , true);


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
