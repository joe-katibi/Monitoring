<?php

namespace App\Http\Controllers\QualityAnalyst;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FiberWelcomeQuestion;
use App\Models\User;
use App\Models\Role;
use App\Models\AlertForm;
use App\Models\Result;
use App\Models\Permission;
use App\Models\Positions;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Categories;
use Datatables;

class EscalationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {

        $tittle = Categories::where('id', '=', $category)->first();
        $agents = User::where('category', '=', $category)->where('position','=','Agent')->get();
        $supervisor = User::where('category', '=', $category)->where('position','=','Supervisor')->first();
        $questions = FiberWelcomeQuestion::where('category', '=', $category)->get();

        // print_pre( [ $supervisor], true);
        $data['tittle'] = $tittle ;
        $data['agents'] = $agents ;
        $data['supervisor'] = $supervisor ;
        $data['questions'] = $questions ;

        return view('quality_analyst/escalationteamcategory')->with($data);

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

        $input = $request->all();

        // print_pre( $totals , true  );

        try {

            DB::beginTransaction();

            $results = new Result();
            $results->supervisor= isset($input['supervisor']) ? $input['supervisor'] : "";
            $results->category= isset($input['category']) ? $input['category'] : "";
            $results->agent_name= isset($input['agent_name']) ? $input['agent_name'] : "";
            $results->quality_analysts= isset($input['quality_analysts']) ? $input['quality_analysts'] : "";
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
            $results->ticket_status = isset($input['ticket_status']) ? $input['ticket_status'] : "";
            $results->percentage = isset($input['percentage']) ? $input['percentage'] : "";
            $results->results = isset($input['results']) ? $input['results'] : 0;
            $results->totals = isset($input['totals']) ? $input['totals'] : 0;
            $results->date_updated = isset($input['date_recorded']) ?  Carbon::parse($input['date_recorded'])->format('Y-m-d H:i:s') :  Carbon::now()->format('Y-m-d H:i:s');

            // print_pre( $results , true);
            $results->save();

            log::channel('escalation_category')->info('escalation Category Created : ------> ', ['200' , $results->toArray() ] );

            foreach ($input['question_no_'] as $key => $value) {

                $question_results = new QuestionResults();

                $question_results->results =  $results->id;
                $question_results->question_no = $key;
                $question_results->marks = $value;
                $question_results->created_by = 1;
                $question_results->save();

                log::channel('escalation_category')->info('escalation Category Created : ------> ', ['200' , $question_results->toArray() ] );
            }

            $totals = QuestionResults::where('results' , '=',  $results->id )->sum('marks');
            $results_update = Result::find($results->id);
            $results_update->results  =  $totals;
            $results_update->update();
            log::channel('escalation_category')->info('escalation  Category Updated : ------> ', ['200' , $results_update->toArray() ] );

            DB::commit();

             //print_pre([$results , $totals] , true);
            return redirect('fiber_escalation_results');

        } catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
        }


        //print_pre($input , true);


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
