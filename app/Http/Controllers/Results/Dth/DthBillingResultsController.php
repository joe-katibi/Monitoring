<?php

namespace App\Http\Controllers\Results\Dth;

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
use Carbon\Carbon;
use Datatables;

class DthBillingResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $question_v = Result::find($id)->join('question_results','question_results.results','=','results.id')
                                        ->join('fiber_welcome_questions','fiber_welcome_questions.id','=','question_results.question_no')
                                         ->select('question_results.results','question_results.marks','results.id','results.supervisor',
                                         'results.agent_name','results.quality_analysts','results.date_recorded','results.category',
                                         'results.customer_account','results.recording_id','results.final_results','results.qa_call_category',
                                         'results.qa_call_nature','results.agent_call_category','results.agent_call_nature','results.general_issue',
                                         'results.specific_issue','results.feedback_from_qc','question_results.question_no',
                                         'fiber_welcome_questions.question','fiber_welcome_questions.number',)
                                        ->where('question_results.results','=',$id)
                                        ->get();

         foreach($question_v as $key => $value){

                                            $agentName = User::where('id','=', $value['agent_name'])->first();
                                            $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                                            $SupervisorName = User::where('id','=', $value['supervisor'])->first();
                                            $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                                            $qualityName = User::where('id','=', $value['quality_analysts'])->first();
                                            $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

                                            $createdAt = $value->date_recorded;

                                            $monthName = Carbon::parse($createdAt)->format('F');
                                            $value['monthName'] =  isset($createdAt)  ?  $monthName: '';

                                            $weekNumber = Carbon::parse($createdAt)->format('W');
                                            $weekNumberWithPrefix = "week " . $weekNumber;
                                            $value['weekNumberWithPrefix'] =  isset($createdAt)  ?  $weekNumberWithPrefix: '';

                                        }

                   $data['question_v'] = $question_v;

        return view('results/Dth/dth_billing_results')->with($data);
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
        $question_v = Result::find($id)->join('question_results','question_results.results','=','results.id')
        ->join('fiber_welcome_questions','fiber_welcome_questions.id','=','question_results.question_no')
         ->select('question_results.results','question_results.marks','results.id','results.supervisor',
         'results.agent_name','results.quality_analysts','results.date_recorded','results.category',
         'results.customer_account','results.recording_id','results.final_results','results.qa_call_category',
         'results.qa_call_nature','results.agent_call_category','results.agent_call_nature','results.general_issue',
         'results.specific_issue','results.feedback_from_qc','question_results.question_no',
         'fiber_welcome_questions.question','fiber_welcome_questions.number',)
        ->where('question_results.results','=',$id)
        ->get();


        foreach($question_v as $key => $value){

            $agentName = User::where('id','=', $value['agent_name'])->first();
            $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

            $SupervisorName = User::where('id','=', $value['supervisor'])->first();
            $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

            $qualityName = User::where('id','=', $value['quality_analysts'])->first();
            $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

            $createdAt = $value->date_recorded;

            $monthName = Carbon::parse($createdAt)->format('F');
            $value['monthName'] =  isset($createdAt)  ?  $monthName: '';

            $weekNumber = Carbon::parse($createdAt)->format('W');
            $weekNumberWithPrefix = "week " . $weekNumber;
            $value['weekNumberWithPrefix'] =  isset($createdAt)  ?  $weekNumberWithPrefix: '';

        }

             $data['question_v'] = $question_v;

            // print_pre([$data] , true);


        return view('results/Dth/dth_edit_results')->with($data);
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
