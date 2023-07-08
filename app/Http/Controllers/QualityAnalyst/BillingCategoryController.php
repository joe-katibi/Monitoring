<?php

namespace App\Http\Controllers\QualityAnalyst;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Models\FiberWelcomeQuestion;
use App\Models\User;
use App\Models\UserCategory;
use App\Models\Role;
use App\Models\AlertForm;
use App\Models\Result;
use App\Models\ReportType;
use App\Models\QuestionResults;
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
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Jobs\AuditJob;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuditNotification;



class BillingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {

        // Get the category title for the given category ID
        $tittle = Categories::where('id', '=', $category)->first();

        // Get all agents for the given category
        //$agents = User::where('category', '=', $category)->where('position', '=', 'Agent')->get();
        $agentRole_id = Role::select('roles.id',)->where('name', '=', 'Agent')->first();

        $agents = User::select('users.name','users.id','model_has_roles.role_id','user_categories.category_id','categories.category_name')
                          ->join('model_has_roles','model_id','=','users.id')
                           ->join('roles','roles.id','=','model_has_roles.role_id')
                          ->join('user_categories','user_categories.user_id','=','users.id')
                          ->join('categories','categories.id','=','user_categories.category_id')
                          ->where('model_has_roles.role_id','=',$agentRole_id->id)
                          ->where('user_categories.category_id',$category)
                          ->get();

        // Get the supervisor for the given category
        //$supervisor = User::where('category', '=', $category)->where('position', '=', 'Supervisor')->get();
        $supervisorRole_id = Role::select('roles.id',)->where('name', '=', 'team-leader')->first();

        $supervisor= User::select('users.name','users.id','model_has_roles.role_id','user_categories.category_id','categories.category_name')
        ->join('model_has_roles','model_id','=','users.id')
         ->join('roles','roles.id','=','model_has_roles.role_id')
        ->join('user_categories','user_categories.user_id','=','users.id')
        ->join('categories','categories.id','=','user_categories.category_id')
        ->where('model_has_roles.role_id','=',$supervisorRole_id->id)
        ->where('user_categories.category_id',$category)
        ->get();

        // Get all FiberWelcomeQuestions for the given category
        $questions = FiberWelcomeQuestion::where('category', '=', $category)->get();

        // Get all categories with service_id = 1
        $cat = Categories::where('service_id', '=', 1)->get();

        // Get all summaries with summary_title = 'Strength Summary'
        $sumry  =  Summary::where('summary_title', '=', 'Strength Summary')->get();

        // Get all GapSummaries with gap_title = 'Gap Summary'
        $sumgap = GapSummaries::where('gap_title', '=', 'Gap Summary')->get();

        // Get all summaries with summary_title = 'VOC Summary'
        $sumvoc = Summary::where('summary_title', '=', 'VOC Summary')->get();

        // Get all agents for category 'Cable Live Calls'
        $liveagent = User::where('category', '=', 'Cable Live Calls')->where('position', '=', 'Agent')->get();

        // Get all CallTracker records
        $crm = CallTracker::all()->toArray();

        // Get all IssueGeneral records
        $general_issue = IssueGeneral::all()->toArray();

        // Get all Reporttype records
        $reporttype = ReportType::select('report_types.type_id','report_types.type_name')->where('id', '=', 1)->first();

        // Get all SubCallTracker records with sub_call_trackers.sub_call_tracker and sub_call_trackers.call_tracker_id
        $subcrm = SubCallTracker::select('sub_call_trackers.sub_call_tracker','sub_call_trackers.call_tracker_id')
            ->join('call_trackers', 'call_trackers.id', '=', 'sub_call_trackers.call_tracker_id')->get();

        // Create an array of data to be passed to the view
        $data['tittle'] = $tittle;
        $data['agents'] = $agents;
        $data['supervisor'] = $supervisor;
        $data['questions'] = $questions;
        $data['cat'] = $cat;
        $data['sumry'] = $sumry;
        $data['sumgap'] = $sumgap;
        $data['sumvoc'] = $sumvoc;
        $data['liveagent'] = $liveagent;
        $data['crm'] = $crm;
        $data['subcrm'] = $subcrm;
        $data['general_issue'] = $general_issue;
        $data['reporttype'] = $reporttype;


        //print_pre($teamleader,true);

        // dd($Agentnew);

        // Return a view based on the category
        return view(($category == 8 )?'quality_analyst/livecallsteamcategory':'quality_analyst/billingteamcategory')->with($data);
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
        // Retrieve all input data from the request and store it in the $input variable.
        $input = $request->all();

        $agent = $request->input('agent_name');

        $supervisor = $request->input('supervisor');

        $qualityAnalysts = $request->input('quality_analysts');

        $agentEmail = User::select('email','name')->where('id', '=', $agent)->first();

        $supervisorEmail = User::select('email','name')->where('id', '=', $supervisor)->first();

        $qualityAnalysts = User::select('email','name')->where('id', '=', $qualityAnalysts)->first();


        try {
            // Begin a database transaction.
            DB::beginTransaction();

             // Create a new Result object.
            $results = new Result();

            // Set each attribute of the Result object to the corresponding value from the input data (if it exists).
            $results->supervisor= isset($input['supervisor']) ? $input['supervisor'] : "";
            $results->category= isset($input['category']) ? $input['category'] : "";
            $results->agent_name= isset($input['agent_name']) ? $input['agent_name'] : "";
            $results->quality_analysts = isset($input['quality_analysts']) ? $input['quality_analysts'] : "";
            $results->date_recorded = isset($input['date_recorded']) ? Carbon::parse($input['date_recorded'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
            $results->customer_account= isset($input['customer_account']) ? $input['customer_account'] : 0;
            $results->recording_id = isset($input['recording_id']) ? $input['recording_id'] : 0;
            $results->qa_call_category = isset($input['qa_call_category']) ? $input['qa_call_category'] : "";
            $results->qa_call_nature = isset($input['qa_call_nature']) ? $input['qa_call_nature'] : "";
            $results->agent_call_category = isset($input['agent_call_category']) ? $input['agent_call_category'] : "";
            $results->agent_call_nature = isset($input['agent_call_nature']) ? $input['agent_call_nature'] : "";
            $results->general_issue = isset($input['issue_highlighted'] ) ? $input['issue_highlighted'] : "" ;
            $results->specific_issue = isset($input['specific_issue']) ? $input['specific_issue'] : "";
            $results->supervisor_comment = isset($input['supervisor_comment']) ? $input['supervisor_comment'] : "";
            $results->agent_comment = isset($input['agent_comment']) ? $input['agent_comment'] : "";
            $results->feedback_from_qc = isset($input['feedback_from_qc']) ? $input['feedback_from_qc'] : "";
            $results->percentage = isset($input['percentage']) ? $input['percentage'] : "";
            $results->results = isset($input['results']) ? $input['results'] : 0;
            $results->date_updated = isset($input['date_recorded']) ?  Carbon::parse($input['date_recorded'])->format('Y-m-d H:i:s') :  Carbon::now()->format('Y-m-d H:i:s');
            $results->status = '1';
            $results->report_type_id = isset($input['reporttype']) ? $input['reporttype'] :"";


            // Save the new results object to the database.
            $results->save();

             // Dispatch the AuditJob to check the status of the Audit
            AuditJob::dispatch($results);

             // Log the creation of the new billing Category object using the billing category channel.
            log::channel('billing_category')->info('Billing Category Created : ------> ', ['200' , $results->toArray() ] );


            // Loop through each question and store the corresponding question results.
            foreach ($input['question_no_'] as $key => $value) {

                // Create a new QuestionResults object
                $question_results = new QuestionResults();

                // Set the properties of the QuestionResults object
                $question_results->results =  $results->id;
                $question_results->question_no = $key;
                $question_results->marks = $value;
                $question_results->created_by = $results->quality_analysts;

                // dd($question_results);

                // Save the QuestionResults object to the database
                $question_results->save();

                // Log the creation of the QuestionResults object
                log::channel('billing_category')->info('Billing Category Created : ------> ', ['200' , $question_results->toArray() ] );
            }

            // Calculate the total marks for the results
          // $totals = QuestionResults::where('results' , '=',  $results->id )->sum('marks');

          // Query the QuestionResults model for the 'marks' column where 'results' equals $results->id
               $total = QuestionResults::select('marks')->where('results', '=', $results->id)
               //->where('marks', '=', 'Auto Fail')
               ->get();

               foreach ($total as $result) {
                // Check if the 'marks' value is "Auto Fail"
                if ($result->marks == "Auto Fail") {
                    // Assign 5 to $result->marks if it's "Auto Fail"
                    $result->marks = 5;
                } else {
                    // If it's not "Auto Fail", sum up the 'marks' column where 'results' equals $results->id
                    $result->marks = QuestionResults::where('results', '=', $results->id)->sum('marks');
                }
            }


            // Get the Result object for the results
            $results_update = Result::find($results->id);

            // Set the final_results property of the Result object to the total marks
            $results_update->final_results =  $result->marks;


            // Update the Result object in the database
            $results_update->save();

          //  print_pre($results_update->final_results , true);

            // Log the update of the Result object
            log::channel('billing_category')->info('Billing Category Updated : ------> ', ['200' , $results_update->toArray() ] );

            // Commit the transaction
            DB::commit();

            // Check if the total marks are 0
            if ($results_update->final_results == 5) {
                // Display a warning message if the total marks are 0



                    $result = new Result();
                    $result->agentEmail = $agentEmail;
                    $result->supervisorEmail = $supervisorEmail;
                    $result->qualityAnalysts = $qualityAnalysts;


                    $notification = new AuditNotification($result, 'results');
                    Mail::to($agentEmail->email)
                        ->cc($supervisorEmail->email)->send($notification);

                toast('Auto Fail generated', 'warning')->position('top-end');
                return redirect()->to('/quality_analyst/qa_agent_alert_form/'.$results->id);
            } else {
                // Display a success message if the total marks are not 0
                $result = new Result();
                $result->marks = $results->marks;
                $result->qualityAnalysts = $qualityAnalysts;
                $result->agentEmail = $agentEmail;
                $result->supervisorEmail = $supervisorEmail;

                $notification = new AuditNotification($result, 'results');
                Mail::to($agentEmail->email)
                    ->cc($supervisorEmail->email)->send($notification);

                toast('Agent Audited successfully', 'success')->position('top-end');
                return redirect('results/billing/billing_results/'.$results->id);
            }





            // Debugging statement (commented out)
            // print_pre([$results , $totals] , true);

            // Catch any exceptions and roll back the transaction
            } catch (\Throwable $e) {

                DB::rollBack();
                Log::info($e->getMessage() );
                throw $e;
            }
        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()

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
    public function update(Request $request, $id, Audit $audit)
    {

        $audit->update($request->all());

        // Dispatch the job to check the status of the audit
        dispatch(new AuditJob($audit));
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
