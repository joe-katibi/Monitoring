<?php

namespace App\Http\Controllers\CallTracker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Datatables;
use App\Models\CallTracker;
use App\Models\SubCallTracker;
use App\Models\Services;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class TrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $crm['list'] = CallTracker::select('call_trackers.id','call_trackers.call_tracker','call_trackers.created_at','call_trackers.service_id',
                                   'sub_call_trackers.sub_call_tracker','sub_call_trackers.sub_call_tracker','services.service_name', 'sub_call_trackers.id')
                                   ->join('sub_call_trackers','sub_call_trackers.call_tracker_id','=','call_trackers.id')
                                   ->join('services','services.id','=','call_trackers.service_id')
                                   ->get();


                                //  dd($crm);


        return view('call_tracker/tracker_view',$crm);
    }

    Public function Crmfetcher(Request $request)

    {

        $data ['sub_trackers'] = SubCallTracker::Where('call_tracker_id','=',$request->id)->get(['sub_call_tracker','id']);

        // dd($data);
        return response()->json($data);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // dd(1);

        // $category[0]->id();
        // $crm = CallTracker::all()->toArray();
        $crm = CallTracker::select('call_trackers.id','call_trackers.call_tracker','call_trackers.service_id','services.service_name')
                                  ->join('services','services.id','=','call_trackers.service_id')
                                  ->get();
         $service = Services::all()->toArray();

        $data['crm']=$crm;
        $data['service']=$service;



        return view('call_tracker.create_tracker')->with($data);
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



         $request->validate([
            'call_tracker'=>'required',
            'service_id'=>'required',
        ]);

        try{

            DB::beginTransaction();

            $callcategory = new CallTracker();
            $callcategory->call_tracker = isset($input['call_tracker']) ? $input['call_tracker']:"";
            $callcategory->service_id = isset($input['service_id']) ? $input['service_id']:"";
           //dd($input, $callcategory);
            $callcategory->save();

            DB::commit();

            //log::channel('call_category')->info('call category Created :------> '.['200', $callcategory->toArray()]);


            toast('Category Created successfully','success')->position('top-end');
            return redirect('call_tracker/create');

        }catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
        }

    }

     /**
     * storesub a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_sub(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'sub_call_tracker'=>'required',
            'call_tracker_id'=>'required',
        ]);

        try{

            DB::beginTransaction();

            $subcallcategory  = new SubCallTracker();
            $subcallcategory->sub_call_tracker = isset($input['sub_call_tracker']) ? $input['sub_call_tracker']:"";
            $subcallcategory->call_tracker_id = isset($input['call_tracker_id']) ? $input['call_tracker_id']:"";

            $subcallcategory->save();

            // log::channel('subcallcategory')->info('sub call category Created : ------> ', ['200' , $subcallcategory->toArray() ] );

            DB::commit();

            return redirect('call_tracker/create');

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
        return view('/call_tracker/show_tracker');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('call_tracker.edit_tracker');
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
