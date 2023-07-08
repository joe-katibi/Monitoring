<?php

namespace App\Http\Controllers\QualityAnalyst;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
use App\Models\LiveCalls;
use App\Models\LiveCalls_results;
use App\Models\livecalls_summary;
use App\Models\CallTracker;
use App\Models\GapSummaries;
use App\Models\Summary;
use App\Models\IssueGeneral;
use Carbon\Carbon;
use App\Models\ReportType;
use Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuditNotification;


class LiveCallCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)


    {

        // Retrieve the LiveCalls record with the specified ID and select the listed columns.
        $fiberlivecalls = LiveCalls::find($id)->select('live_calls.id','live_calls.account_number','live_calls.date','live_calls.quality_analysts','live_calls.category','live_calls.supervisor',
                                                       'live_calls.agent', 'live_calls.issue_summary','live_calls.issue_description','live_calls.strength_summary','live_calls.strength_description','live_calls.gaps_summary','live_calls.gaps_description','live_calls.voc_summary','live_calls.voc_description','categories.category_name','live_calls_results.summary_id as gapSummary','livecalls_summaries.summary_id as strengthSummary', 'summaries.summary_name','gap_summaries.gap_name',
                                                       )
                                                 ->join('categories','categories.id','=','live_calls.category')
                                                 ->join('livecalls_summaries','livecalls_summaries.livecall_id','=','live_calls.id')
                                                 ->join('live_calls_results','live_calls_results.livecall_id','=','live_calls.id')
                                                 ->join('summaries','summaries.id','=','live_calls_results.summary_id')
                                                 ->join('gap_summaries','gap_summaries.id','=','livecalls_summaries.summary_id')
                                                ->where('live_calls.id','=',$id)->get();


        foreach($fiberlivecalls as $key => $value) {

            $agentName = User::where('id','=', $value['agent'])->first();
            $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

            $SupervisorName = User::where('id','=', $value['supervisor'])->first();
            $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

            $qualityName = User::where('id','=', $value['quality_analysts'])->first();
            $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

          }

          $gapResults = livecalls_summary::select('summary_id','gap_summaries.gap_name')
                                                         ->join('live_calls','live_calls.id','=','livecalls_summaries.livecall_id')
                                                         ->join('gap_summaries','gap_summaries.id','=','summary_id')
                                                        ->where('livecall_id','=',$id)
                                                         ->get();


          $strengthResults = LiveCalls_results::select('summary_id','summaries.summary_name')
                                                     ->join('live_calls','live_calls.id','=','live_calls_results.livecall_id')
                                                     ->join('summaries','summaries.id','=','summary_id')
                                                     ->where('livecall_id','=',$id)
                                                     ->get();

              //print_pre([$strengthResults ] , true);

        // Store the retrieved LiveCalls record in an array with the key 'fiberlivecalls'.
        $data['fiberlivecalls'] = $fiberlivecalls ;
        $data['gapResults'] = $gapResults ;
        $data['strengthResults'] = $strengthResults ;

        // Render the 'fiber_livecalls_results' view and pass the $data array as the view's data.
        return view('results/Fiber/fiber_livecalls_results')->with($data);

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

    $agent = $request->input('agent');

    $supervisor = $request->input('supervisor');

    $qualityAnalysts = $request->input('quality_analysts');

    $agentEmail = User::select('email','name')->where('id', '=', $agent)->first();

    $supervisorEmail = User::select('email','name')->where('id', '=', $supervisor)->first();

    $qualityAnalysts = User::select('email','name')->where('id', '=', $qualityAnalysts)->first();


    try {
        // Begin a database transaction.
        DB::beginTransaction();

        // Create a new LiveCalls object.
        $fiberlivecalls = new LiveCalls();

        // Set each attribute of the LiveCalls object to the corresponding value from the input data (if it exists).
        $fiberlivecalls->tittle = 'Fiber Live Calls';
        $fiberlivecalls->account_number = isset($input['account_number']) ? $input['account_number'] : "";
        $fiberlivecalls->recording_id = isset($input['recording_id']) ? $input['recording_id'] : "";
        $fiberlivecalls->quality_analysts = isset($input['quality_analysts']) ? $input['quality_analysts'] : "";
        $fiberlivecalls->date = isset($input['date']) ? $input['date'] : "";
        $fiberlivecalls->category = isset($input['category']) ? $input['category'] : "";
        $fiberlivecalls->supervisor = isset($input['supervisor']) ? $input['supervisor'] : "";
        $fiberlivecalls->agent = isset($input['agent']) ? $input['agent'] : "";
        $fiberlivecalls->issue_summary = isset($input['issue_summary']) ? $input['issue_summary'] : "";
        $fiberlivecalls->issue_description = isset($input['issue_description']) ? $input['issue_description'] : "";
        $fiberlivecalls->strength_description = isset($input['strength_description']) ? $input['strength_description'] : "";
        $fiberlivecalls->gaps_description = isset($input['gaps_description']) ? $input['gaps_description'] : "";
        $fiberlivecalls->voc_summary = isset($input['voc_summary']) ? $input['voc_summary'] : "";
        $fiberlivecalls->voc_description = isset($input['voc_description']) ? $input['voc_description'] : "";
        $fiberlivecalls->report_type_id = isset($input['reporttype']) ? $input['reporttype'] :"";

        // exit;
        // Save the new LiveCalls object to the database.
        $fiberlivecalls->save();

        foreach($input['strength_summary'] as $key =>$value){

            $strength = new LiveCalls_results();
            $strength->livecall_id = $fiberlivecalls->id;
            $strength->summary_id = $value;
            $strength->category_id = $fiberlivecalls->category;
            $strength->created_by =$fiberlivecalls->quality_analysts;

            $strength->save();

            // Log the creation of the new LiveCalls object using the fiberlivecalls channel.
        log::channel('strengthSummaryaudit')->info('live calls Strength Summary audited : ------> ', ['200' , $strength->toArray() ] );


        }

        foreach($input['gaps_summary'] as $key =>$value){

            $gap = new livecalls_summary();
            $gap->livecall_id = $fiberlivecalls->id;
            $gap->summary_id = $value;
            $gap->category_id = $fiberlivecalls->category;
            $gap->created_by = $fiberlivecalls->quality_analysts;

            $gap->save();

            // Log the creation of the new LiveCalls object using the fiberlivecalls channel.
        //log::channel('gapSummaryaudit')->info('live calls Gap Summary audited : ------> ', ['200' , $gap-->toArray() ] );


        }


        // Display a success message to the user using the toast package.
        toast('Live Call Audited successfully', 'success')->position('top-end');

        // Log the creation of the new LiveCalls object using the fiberlivecalls channel.
        log::channel('fiberlivecalls')->info('fiber livecalls Created : ------> ', ['200' , $fiberlivecalls->toArray() ] );

        // Commit the transaction to save the changes to the database.
        DB::commit();


        $liveCall = new LiveCalls();

        $liveCall->marks = $fiberlivecalls->tittle;
        $liveCall->qualityAnalysts = $qualityAnalysts;
        $liveCall->agentEmail = $agentEmail;
        $liveCall->supervisorEmail = $supervisorEmail;

        $notification = new AuditNotification($liveCall, 'liveCalls');
        Mail::to($agentEmail->email)->cc($supervisorEmail->email)->send($notification);

        // Redirect the user to the 'fiber_livecalls_results' view for the new LiveCalls object.
        return redirect('results/Fiber/fiber_livecalls_results/'.$fiberlivecalls->id);

    } catch (\Throwable $e) {
        // If an error occurs, roll back the transaction, log the error, and re-throw the exception.
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
    public function show($id)
    {

       // dd($id);
        // Retrieve the LiveCalls record with the specified ID and select the listed columns.
        $fiberlivecalls = LiveCalls::select('live_calls.id','live_calls.account_number','live_calls.date','live_calls.quality_analysts','live_calls.category','live_calls.supervisor','live_calls.agent',
                                             'live_calls.issue_summary','live_calls.issue_description','live_calls.strength_summary','live_calls.strength_description','live_calls.gaps_summary','live_calls.gaps_description','live_calls.voc_summary','live_calls.voc_description','categories.category_name','summaries.summary_name','gap_summaries.gap_name',)
                                           ->join('categories','categories.id','=','live_calls.category')
                                           ->join('summaries','summaries.id','=','live_calls.strength_summary')
                                           ->join('gap_summaries','gap_summaries.id','=','live_calls.gaps_summary')
                                           ->join('users','users.category','=','live_calls.category')
                                           ->where('live_calls.id','=',$id)->first();

          foreach($fiberlivecalls as $key => $value) {

            $agentName = User::where('id','=', $value['agent'])->first();
            $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

            $SupervisorName = User::where('id','=', $value['supervisor'])->first();
            $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

            $qualityName = User::where('id','=', $value['quality_analysts'])->first();
            $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

          }



         // Store the retrieved LiveCalls record in an array with the key 'fiberlivecalls'.
        $data['fiberlivecalls'] = $fiberlivecalls ;

        // Render the 'fiber_livecalls_results' view and pass the $data array as the view's data.
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
}
