<?php

namespace App\Http\Controllers\CallSummary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Summary;
use App\Models\LiveCalls;
use App\Models\GapSummaries;
use App\Models\VoCSummaries;
use App\Models\Services;
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
        $sumry  =  Summary::select('summaries.id','summaries.summary_title','summaries.summary_name','summaries.service_id',
                                  'summaries.created_at','services.service_name')->join('services','services.id','=','summaries.service_id')->get();
        $sumgap = GapSummaries::select('gap_summaries.id','gap_summaries.gap_title','gap_summaries.gap_name','gap_summaries.service_id',
                            'gap_summaries.created_at','services.service_name')->join('services','services.id','=','gap_summaries.service_id')->get();
        $sumvoc = VoCSummaries::select('vo_c_summaries.id','vo_c_summaries.voc_title','vo_c_summaries.voc_name','vo_c_summaries.service_id',
                          'vo_c_summaries.created_at','services.service_name')->join('services','services.id','=','vo_c_summaries.service_id')->get();
        $services = Services::select('services.id','services.service_name')->get();


   // dd([$sumry, $sumgap, $sumvoc]);
        return view('call_summary/summary', compact('sumry','sumgap','sumvoc','services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createVoc(Request $request)
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

         try {

            DB::beginTransaction();
            $summarystergth = new Summary();
            $summarystergth->summary_title= isset($input['summary_title']) ? $input['summary_title'] : "";
            $summarystergth->summary_name= isset($input['summary_name']) ? $input['summary_name'] : "";
            $summarystergth->service_id = isset($input['service']) ? $input['service'] : "";
            $summarystergth->created_by = Auth::user()->id;
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
        $input = $request->all();

         try {

            DB::beginTransaction();
            $summarygap = new GapSummaries();
            $summarygap->gap_title= isset($input['gap_title']) ? $input['gap_title'] : "";
            $summarygap->gap_name= isset($input['gap_name']) ? $input['gap_name'] : "";
            $summarygap->service_id = isset($input['service']) ? $input['service'] : "";
            $summarygap->created_by = Auth::user()->id;

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
     * Show a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();
            $gapSummary = GapSummaries::findOrFail($id);
            $gapSummary->gap_title= isset($input['gap_title']) ? $input['gap_title'] : "";
            $gapSummary->gap_name= isset($input['gap_name']) ? $input['gap_name'] : "";
            $gapSummary->service_id = isset($input['service']) ? $input['service'] : "";
            $gapSummary->created_by = Auth::user()->id;

            $gapSummary->save();

            log::channel('summarygap')->info('summary Created : ------> ', ['200' , $gapSummary->toArray() ] );

            DB::commit();
            toast('Gap Summary Edited successfully','success')->position('top-end');
            return redirect('call_summary/summary');

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
        }
        
    }

     /**
     * Show a newly created resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voc(Request $request, $id)
    {
        $input = $request->all();
       // dd([$request, $id]);

              try {

            DB::beginTransaction();
            $summarystergth = Summary::findOrFail($id);
            $summarystergth->summary_title= isset($input['summary_title']) ? $input['summary_title'] : "";
            $summarystergth->summary_name= isset($input['summary_name']) ? $input['summary_name'] : "";
            $summarystergth->service_id = isset($input['service']) ? $input['service'] : "";
            $summarystergth->created_by = Auth::user()->id;
            $summarystergth->save();

             log::channel('summarystergth')->info('summary Created : ------> ', ['200' , $summarystergth->toArray() ] );

             DB::commit();
             toast('Strength Summary Edited successfully','success')->position('top-end');
             return redirect('summary');

        }catch (\Throwable $e) {
            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $input = $request->all();
       
        try {
            DB::beginTransaction();
            $vocSummary = VoCSummaries::findOrFail($id);
            $vocSummary->voc_title = isset($input['VOC_title']) ? $input['VOC_title'] : "";
            $vocSummary->voc_name  = isset($input['voc_name']) ? $input['voc_name'] : "";
            $vocSummary->service_id  = isset($input['service']) ? $input['service'] : "";
            $vocSummary->created_by = Auth::user()->id;
            $vocSummary->save();

            log::channel('summaryvoc')->info('VOC Created : ------> ', ['200' , $vocSummary->toArray() ] );

            DB::commit();
            toast('VOC Summary Edited successfully','success')->position('top-end');
            return redirect('call_summary/summary');

        } catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();
            $vocSummary = new VoCSummaries();
            $vocSummary->voc_title = isset($input['VOC_title']) ? $input['VOC_title'] : "";
            $vocSummary->voc_name  = isset($input['voc_name']) ? $input['voc_name'] : "";
            $vocSummary->service_id  = isset($input['service']) ? $input['service'] : "";
            $vocSummary->created_by = Auth::user()->id;
            $vocSummary->save();

            log::channel('summaryvoc')->info('VOC Created : ------> ', ['200' , $vocSummary->toArray() ] );

            DB::commit();
            toast('VOC Summary Created successfully','success')->position('top-end');
            return redirect('summaryview');

        } catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
        }

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
