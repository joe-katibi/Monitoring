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
use App\Models\CallTracker;
use Datatables;


class LiveCallCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {

        $tittle = Categories::where('id', '=', $category)->first();
        $cat = Categorie::all()->toArray();
        $agents = User::where('category', '=', $category)->where('position','=','Agent')->get();
        $supervisor = User::where('category', '=', $category)->where('position','=','Supervisor')->first();
        $questions = FiberWelcomeQuestion::where('category', '=', $category)->get();
        $crm = CallTracker::all()->toArray();

         print_pre( [ $supervisor], true);

        $data['tittle'] = $tittle ;
        $data['agents'] = $agents ;
        $data['supervisor'] = $supervisor ;
        $data['questions'] = $questions ;
        $data['cat'] = $cat ;
        $data['crm'] = $crms ;

        return view('quality_analyst/livecallsteamcategory')->with($data);

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

        //  print_pre( $input , true  );

        try {

            DB::beginTransaction();

            $livecall = new LiveCalls();
            $livecall->tittle= isset($input['tittle']) ? $input['tittle'] : "";
            $livecall->account_number= isset($input['account_number']) ? $input['account_number'] : "";
            $livecall ->quality_analysts= isset($input['quality_analysts']) ? $input['quality_analysts'] : "";
            $livecall ->date= isset($input['date']) ? $input['date'] : "";
            // $livecall ->date_recorded = isset($input['date']) ? Carbon::parse($input['date'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
            $livecall->category= isset($input['category']) ? $input['category'] : 0;
            $livecall->supervisor = isset($input['supervisor']) ? $input['supervisor'] : 0;
            $livecall->agent = isset($input['agent']) ? $input['agent'] : "";
            $livecall->issue_summary = isset($input['issue_summary']) ? $input['issue_summary'] : "";
            $livecall->issue_description = isset($input['issue_description']) ? $input['issue_description'] : "";
            $livecall->strength_summary = isset($input['strength_summary']) ? $input['strength_summary'] : "";
            $livecall->strength_description = isset($input['strength_description'] ) ? $input['strength_description'] : "" ;
            $livecall->gaps_summary = isset($input['gaps_summary']) ? $input['gaps_summary'] : "";
            $livecall->gaps_description = isset($input['gaps_description']) ? $input['gaps_description'] : "";
            $livecall->voc_summary = isset($input['voc_summary']) ? $input['voc_summary'] : "";
            $livecall->voc_description = isset($input['voc_description']) ? $input['voc_description'] : "";


            print_pre( $livecall , true);
          //  $livecall->save();

            log::channel('livecall_category')->info('livecall Category Created : ------> ', ['200' , $livecall->toArray() ] );

            DB::commit();

             //print_pre([$livecall , $totals] , true);
            return redirect('fiber_livecalls_results');

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
        $livecall = livecall::find($id);

        return view('results/Fiber/fiber_livecalls_results',compact('livecall'));
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
