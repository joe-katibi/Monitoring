<?php

namespace App\Http\Controllers\CallSummary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Summary;
use App\Models\LiveCalls;
use App\Models\GapSummaries;
use App\Models\VoCSummaries;
use Datatables;

class CallSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sumry  =  Summary::where('summary_title','=','Strength Summary')->get();
        $sumgap = GapSummaries::where('gap_title','=','Gap Summary')->get();
        $sumvoc = Summary::where('summary_title','=','VOC Summary')->get();

        // dd($sumgap);
        return view('call_summary/summary', compact('sumry','sumgap','sumvoc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $input = $request->all();

        toast('VOC Summary Created successfully','success')->position('top-end');
        // print_pre( $input , true  );
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

            $summarystergth = new Summary();
            $summarystergth->summary_title= isset($input['summary_title']) ? $input['summary_title'] : "";
            $summarystergth->summary_name= isset($input['summary_name']) ? $input['summary_name'] : "";

            // print_pre( $summary , true);

             $summarystergth->save();

             log::channel('summarystergth')->info('summary Created : ------> ', ['200' , $summarystergth->toArray() ] );

             DB::commit();

             toast('Strength Summary Created successfully','success')->position('top-end');

             return redirect('summary');


        }catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
        }
    }


        /**
     * storeGap a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGap(Request $request)
    {
        //
        $input = $request->all();

        //  print_pre( $input , true  );

         try {

            DB::beginTransaction();

            $summarygap = new GapSummaries();
            $summarygap->gap_title= isset($input['gap_title']) ? $input['gap_title'] : "";
            $summarygap->gap_name= isset($input['gap_name']) ? $input['gap_name'] : "";

            // print_pre( $summary , true);

             $summarygap->save();

             log::channel('summarygap')->info('summary Created : ------> ', ['200' , $summarygap->toArray() ] );

             DB::commit();
             toast('Gap Summary Created successfully','success')->position('top-end');
             return redirect('summary');


        }catch (\Throwable $e) {

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
        $destroy =DB::table('summaries')->where('id',$id)->delete();

        return redirect('summary');
    }
}
