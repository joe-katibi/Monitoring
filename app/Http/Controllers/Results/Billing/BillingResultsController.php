<?php

namespace App\Http\Controllers\Results\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\FiberWelcomeQuestion;
use App\Models\User;
use App\Models\Role;
use App\Models\AlertForm;
use App\Models\Result;
use App\Models\QuestionResults;
use App\Models\Permission;
use App\Models\Positions;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Categories;
use Datatables;

class BillingResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $agentId = Role::select('roles.id',)->where('name', '=', 'Agent')
        //                         ->join('model_has_roles','model_has_roles.role_id','=','roles.id')
        //                        ->first();
        // $supervisorId
        // $qualityId

        //dd($id);


        // Find a record in the Result model with the given $id value, and join it with two other tables
        $question_v = Result::find($id)
                                ->join('question_results', 'question_results.results', '=', 'results.id')
                                ->join('fiber_welcome_questions', 'fiber_welcome_questions.id', '=', 'question_results.question_no')
                                ->join('users','users.id','=','results.agent_name')

                                // Select specific columns from the joined tables
                                ->select('question_results.results', 'question_results.marks', 'results.id', 'results.supervisor', 'results.agent_name', 'results.quality_analysts',
                                        'results.date_recorded', 'results.category', 'results.customer_account', 'results.recording_id', 'results.final_results',
                                        'results.qa_call_category', 'results.qa_call_nature', 'results.agent_call_category', 'results.agent_call_nature', 'results.general_issue',
                                        'results.specific_issue', 'results.feedback_from_qc', 'results.results', 'question_results.question_no', 'fiber_welcome_questions.question',
                                        'fiber_welcome_questions.number',)

                                // Filter the joined records by question_results.results = $id
                                ->where('question_results.results', '=', $id)
                                ->get();

                                foreach($question_v as $key => $value)
                                {

                                    $agentName = User::where('id','=', $value['agent_name'])->first();
                                    $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                                    $SupervisorName = User::where('id','=', $value['supervisor'])->first();
                                    $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                                    $qualityName = User::where('id','=', $value['quality_analysts'])->first();
                                    $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';
                                }

                                //print_pre($question_v, true);

        // Create an associative array $data that contains the question_v array
        $data['question_v'] = $question_v;

        // Render a view called 'results/billing/billing_results' and pass the $data array to it
        return view('results/billing/billing_results')->with($data);
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
    // Find the result and join the question_results and fiber_welcome_questions tables
    $audit_agent =Result::find($id)->join('question_results','question_results.results','=','results.id')
                                   ->join('fiber_welcome_questions','fiber_welcome_questions.id','=','question_results.question_no')
                                   ->select('question_results.results','question_results.marks','question_results.question_no','question_results.created_by',
                                            'results.id','results.supervisor','results.agent_name','results.quality_analysts',
                                            'results.date_recorded','results.category','results.customer_account',
                                            'results.recording_id','results.final_results','results.qa_call_category','results.qa_call_nature',
                                            'results.agent_call_category','results.agent_call_nature','results.general_issue','results.specific_issue',
                                            'results.feedback_from_qc','results.results','question_results.question_no','fiber_welcome_questions.question',
                                            'fiber_welcome_questions.number',
                                            'fiber_welcome_questions.id as r_id','fiber_welcome_questions.yes','fiber_welcome_questions.no')
                                    ->where('question_results.results','=',$id)
                                    ->get();

    // Store the audit_agent in the $data array
    $data['audit_agent'] = $audit_agent;

    // Display a success message using the toast function
    toast('Audit Updated successfully','success');

    // Uncomment the following line to dump the $data variable and inspect its contents
    //dd($data);

    // Return the billing_edit view and pass the $data array to it
    return view('results/billing/billing_edit')->with($data);
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
