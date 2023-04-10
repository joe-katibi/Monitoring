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
use App\Models\ReportType;
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class DthLiveCallCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)


    {
        // Retrieve the LiveCalls record with the specified ID and select the listed columns.

        $dthlivecalls = LiveCalls::find($id)
        ->select('live_calls.id','live_calls.account_number','live_calls.date','live_calls.quality_analysts','live_calls.category','live_calls.supervisor','live_calls.agent',
        'live_calls.issue_summary','live_calls.issue_description','live_calls.strength_summary','live_calls.strength_description','live_calls.gaps_summary','live_calls.gaps_description',
        'live_calls.voc_summary','live_calls.voc_description',
        'categories.category_name',
         'summaries.id',
        'gap_summaries.gap_name',
        )

         // Join the categories, summaries, and gap_summaries tables using their respective IDs.
        ->join('categories','categories.id','=','live_calls.category')
       // ->join('summaries','summaries.id','=','live_calls.strength_summary')
         ->join('gap_summaries','gap_summaries.id','=','live_calls.gaps_summary')

         // Filter by the specified LiveCalls ID.
        ->where('live_calls.id','=',$id)->get();

        // Store the retrieved LiveCalls record in an array with the key 'dthlivecalls'.
        $data['dthlivecalls'] = $dthlivecalls ;

        // Render the 'dth_livecalls_results' view and pass the $data array as the view's data.
        return view('results/Dth/dth_livecalls_results')->with($data);


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

        print_pre([$input] , true);


        $request->validate([
            'tittle'=>'required',
            'account_number'=>'required',
            'date'=>'required',
            'category'=>'required',
            'supervisor'=>'required',
            'agent'=>'required',
            'issue_summary'=>'required',
            'issue_description'=>'required',
            'strength_summary'=>'required',
            'strength_description'=>'required',
            'gaps_summary'=>'required',
            'gaps_description'=>'required',
            'voc_summary'=>'required',
            'voc_description'=>'required',
        ]);


        try {

            // Begin a database transaction.
               DB::beginTransaction();

            // Create a new LiveCalls object.
            $dthlivecalls = new LiveCalls();

          // Set each attribute of the LiveCalls object to the corresponding value from the input data (if it exists).
          $dthlivecalls->tittle = 'DTH live Calls';
          $dthlivecalls->account_number = isset($input['account_number']) ? $input['account_number'] : "";
          $dthlivecalls->quality_analysts = isset($input['quality_analysts']) ? $input['quality_analysts'] : "";
          $fiberlivecalls->recording_id = isset($input['recording_id']) ? $input['recording_id'] : "";
          $dthlivecalls->date = isset($input['date']) ? $input['date'] : "";
          $dthlivecalls->category = isset($input['category']) ? $input['category'] : "";
          $dthlivecalls->supervisor = isset($input['supervisor']) ? $input['supervisor'] : "";
          $dthlivecalls->agent = isset($input['agent']) ? $input['agent'] : "";
          $dthlivecalls->issue_summary = isset($input['issue_summary']) ? $input['issue_summary'] : "";
          $dthlivecalls->issue_description = isset($input['issue_description']) ? $input['issue_description'] : "";
          $dthlivecalls->strength_summary = isset($input['strength_summary']) ? $input['strength_summary'] : "";
          $dthlivecalls->strength_description = isset($input['strength_description']) ? $input['strength_description'] : "";
          $dthlivecalls->gaps_summary = isset($input['gaps_summary']) ? $input['gaps_summary'] : "";
          $dthlivecalls->gaps_description = isset($input['gaps_description']) ? $input['gaps_description'] : "";
          $dthlivecalls->voc_summary = isset($input['voc_summary']) ? $input['voc_summary'] : "";
          $dthlivecalls->voc_description = isset($input['voc_description']) ? $input['voc_description'] : "";
          $dthlivecalls->report_type_id = isset($input['reporttype']) ? $input['reporttype'] :"";


          // Save the new LiveCalls object to the database.

          //dd($dthlivecalls);
          $dthlivecalls->save();

          // Display a success message to the user using the toast package.
          toast('Live Call Audited successfully', 'success')->position('top-end');

          // Log the creation of the new LiveCalls object using the dthlivecalls channel.
          log::channel('dthlivecall_category')->info('dthlivecall Category Created : ------> ', ['200' , $dthlivecalls->toArray() ] );

           // Commit the transaction to save the changes to the database.
            DB::commit();

             //print_pre([$results , $totals] , true);
             toast('Live-Call Audited successfully','success')->position('top-end');

             // Redirect the user to the 'dth_livecalls_results' view for the new LiveCalls object.
             return redirect('results/Dth/dth_livecalls_results/'.$dthlivecalls->id);

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
