<?php

namespace App\Http\Controllers\QualityAnalyst;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
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



class BillingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $category)
    {

        // echo $category;

        // exit;

        $tittle = Categories::where('id', '=', $category)->first();
        $agents = User::where('category', '=', $category)->where('position','=','Agent')->get();
        $supervisor = User::where('category', '=', $category)->where('position','=','Supervisor')->first();
        $questions = FiberWelcomeQuestion::where('category', '=', $category)->get();

        //live calls//
        $cat = Categories::where('service_id', '=', 1)->get();
        $sumry  =  Summary::where('summary_title','=','Strength Summary')->get();
        $sumgap = GapSummaries::where('gap_title','=','Gap Summary')->get();
        $sumvoc = Summary::where('summary_title','=','VOC Summary')->get();
       // $livesupervisor = User::where('category', '=', $category)->where('position','=','Supervisor')->first();
        $liveagent = User::where('category', '=', 'Cable Live Calls')->where('position','=','Agent')->get();

        $crm = CallTracker::all()->toArray();
        $general_issue =IssueGeneral::all()->toArray();
        $subcrm = SubCallTracker::select('sub_call_trackers.sub_call_tracker','sub_call_trackers.call_tracker_id')
         ->join('call_trackers', 'call_trackers.id', '=','sub_call_trackers.call_tracker_id')
        // ->where('sub_call_trackers.call_tracker_id','=','call_trackers.id')
           ->get();
        //    $crm = CallTracker::with('sub_call_trackers')->get();

        //print_pre( [ $general_issue], true);
         //dd($subcrm);
        $data['tittle'] = $tittle ;
        $data['agents'] = $agents ;
        $data['supervisor'] = $supervisor ;
        $data['questions'] = $questions ;
        //live Calls//
        $data['cat'] = $cat ;
        $data['sumry'] = $sumry ;
        $data['sumgap'] = $sumgap ;
        $data['sumvoc'] = $sumvoc ;
        // $data['livesupervisor'] = $livesupervisor ;
        $data['liveagent'] = $liveagent ;

        $data['crm'] = $crm ;
        $data['subcrm'] = $subcrm ;
        $data['general_issue'] = $general_issue ;

        // dd($data);




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




            log::channel('billing_category')->info('Billing Category Created : ------> ', ['200' , $results->toArray() ] );

            foreach ($input['question_no_'] as $key => $value) {

                $question_results = new QuestionResults();

                $question_results->results =  $results->id;
                $question_results->question_no = $key;
                $question_results->marks = $value;
                $question_results->created_by = 1;
              //      dd($question_results->results);
                $question_results->save();

                log::channel('billing_category')->info('Billing Category Created : ------> ', ['200' , $question_results->toArray() ] );
            }

            $totals = QuestionResults::where('results' , '=',  $results->id )->sum('marks');
            $results_update = Result::find($results->id);
            $results_update->results  =  $totals;
            $results_update->update();
            log::channel('billing_category')->info('Billing Category Updated : ------> ', ['200' , $results_update->toArray() ] );


            DB::commit();


            // Alert::success('Success Title', 'Success Message');


            // print_pre([$results , $totals] , true);
            return redirect('results/billing/billing_results')->with('Success','your Audit has been Successfully saved');

        } catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
        }
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function livecalls(Request $request)
    {

        $input = $request->all();

        // dd($input);

        //    print_pre( $input , true  );

        try {

            DB::beginTransaction();

            $fiberlivecalls = new LiveCalls();
            $fiberlivecalls->tittle= isset($input['tittle']) ? $input['tittle'] : "";
            $fiberlivecalls->account_number= isset($input['account_number']) ? $input['account_number'] : "";
            $fiberlivecalls->quality_analysts= isset($input['quality_analysts']) ? $input['quality_analysts'] : "";
            $fiberlivecalls->date= isset($input['date']) ? $input['date'] : "";
            $fiberlivecalls->category= isset($input['category']) ? $input['category'] : "";
            $fiberlivecalls->supervisor= isset($input['supervisor']) ? $input['supervisor'] : "";
            $fiberlivecalls->agent= isset($input['agent']) ? $input['agent'] : "";
            $fiberlivecalls->issue_summary= isset($input['issue_summary']) ? $input['issue_summary'] : "";
            $fiberlivecalls->issue_description= isset($input['issue_description']) ? $input['issue_description'] : "";
            $fiberlivecalls->strength_summary= isset($input['strength_summary']) ? $input['strength_summary'] : "";
            $fiberlivecalls->strength_description= isset($input['strength_description']) ? $input['strength_description'] : "";
            $fiberlivecalls->gaps_summary= isset($input['gaps_summary']) ? $input['gaps_summary'] : "";
            $fiberlivecalls->gaps_description= isset($input['gaps_description']) ? $input['gaps_description'] : "";
            $fiberlivecalls->voc_summary= isset($input['voc_summary']) ? $input['voc_summary'] : "";
            $fiberlivecalls->voc_description= isset($input['voc_description']) ? $input['voc_description'] : "";

             // print_pre( $fiberlivecalls , true);

            //  $fiberlivecalls->save();

            //  foreach($input['strength_summary'] as $key => $value){

            //     $livecallsresults = new LiveCalls_results();

            //     $livecallsresults->live_call_id =  $fiberlivecalls->id;
            //     $livecallsresults->strength_id = $key;
            //     $livecallsresults->gaps_summary_id = $value;
            //     $livecallsresults->created_by = 1;

            //     dd($livecallsresults->live_call_id);



            //  }

            //  dd($fiberlivecalls);


            $fiberlivecalls->save();

            Alert::success('Success Title', 'Success Message');

            log::channel('fiberlivecalls')->info('fiber livecalls Created : ------> ', ['200' , $fiberlivecalls->toArray() ] );



          DB::commit();


          return redirect('results/Fiber/fiber_livecalls_results');




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

        // $show = LiveCalls::where('id','=',18)->first();

        $fiberlivecalls =LiveCalls::find(18)
                        ->join('categories','categories.id','=','live_calls.category')
                        ->join('summaries','summaries.id','=','live_calls.strength_summary')
                        ->join('gap_summaries','gap_summaries.id','=','live_calls.gaps_summary')
                        ->select('live_calls.id','live_calls.account_number','live_calls.date','live_calls.quality_analysts','live_calls.category','live_calls.supervisor','live_calls.agent','live_calls.issue_summary','live_calls.issue_description','live_calls.strength_summary','live_calls.strength_description','live_calls.gaps_summary','live_calls.gaps_description','live_calls.voc_summary','live_calls.voc_description','categories.category_name','summaries.summary_name','gap_summaries.gap_name',)
                        ->first();

            //  dd($fiberlivecalls);
;
        // $fiberlivecalls = LiveCalls::all()->toArray();
        // $tittle = Categories::where('category_name','=','Cable Live Calls');
        // $category = Categories::select('categories.id','categories.category_name','live_calls.category')
        //                     ->join('live_calls','live_calls.category','=','categories.id');

                            $data['fiberlivecalls'] = $fiberlivecalls ;
        //                     $data['tittle'] = $tittle ;
        //                     $data['category'] = $category ;

        //                     $data['fiberlivecalls'] = LiveCalls::find(18);

                            //  dd($data);


        return view('results/Fiber/fiber_livecalls_results')->with($data);
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

    public function save(Request $request){

    }
}
