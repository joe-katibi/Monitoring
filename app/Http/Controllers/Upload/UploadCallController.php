<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Services;
use App\Models\User;
use App\Models\Categories;
use App\Models\UploadCalls;
use App\Models\CallRatings;
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class UploadCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Categories::all()->toArray();
        $qa =User::where('position','=','Quality Analyst')->get();
        $agents = User::where('position','=','Agent')->get();
        $supervisor = User::where('position','=','Supervisor')->get();
        $callrating = CallRatings::all()->toArray();
        $upload = UploadCalls::select('upload_calls.agent_name','upload_calls.supervisor_name','upload_calls.call_category','upload_calls.qa_name','upload_calls.call_rating','upload_calls.call_date','upload_calls.call_file','call_ratings.rating_name',)
                               ->join('call_ratings','call_ratings.id','=','upload_calls.call_rating')
                               ->get();



        $data['category']=  $category;
        $data['qa']= $qa;
        $data['agents']=$agents;
        $data['supervisor']=  $supervisor;
        $data['callrating']=  $callrating;
        $data['upload']=  $upload;


        // dd($upload);

        return view('call_saved/upload_calls')->with($data);
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

        $request->validate([
            'agent_name'=>'required',
            'supervisor_name'=>'required',
            'call_category'=>'required',
            'qa_name'=>'required',
            'call_rating'=>'required',
            'call_date'=>'required',
            'call_file'=>'required',

        ]);

        // $file=$request->call_file;
        // $filename=time().'.'.$file->getClientOriginalExtension();
        // $request->file->move('assets',$filename);
        // $data->file=$filename;


        try {
            DB::beginTransaction();

            $callrecord = new UploadCalls();

            $call_file=$request->call_file;
            $filename=time().'.'.$call_file->getClientOriginalExtension();
            $request->call_file->move('assets',$filename);
            $audio_upload_path ='/assets/'.$filename;
            move_uploaded_file($filename,$audio_upload_path);
            $callrecord->call_file = $filename =  isset($input['call_file']) ? $input['call_file']:"";
            // $callrecord->call_file = isset($input['call_file']) ? $input['call_file']:"";

            $callrecord->agent_name = isset($input['agent_name']) ? $input['agent_name']:"";
            $callrecord->supervisor_name = isset($input['supervisor_name']) ? $input['supervisor_name']:"";
            $callrecord->call_category = isset($input['call_category']) ? $input['call_category']:"";
            $callrecord->qa_name = isset($input['qa_name']) ? $input['qa_name']:"";
            $callrecord->call_rating = isset($input['call_rating']) ? $input['call_rating']:"";
            $callrecord->call_date = isset($input['call_date']) ? $input['call_date']:"";


            // swal("Good job!", "You clicked the button!", "success");

            // dd($callrecord);

            // exit;

            $callrecord->save();


            log::channel('callrecord')->info('call record Created : ------> ', ['200' , $callrecord->toArray() ] );

            DB::commit();

            return redirect()->back();

        } catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;

        }

        // swal("Good job!", "You clicked the button!", "danger");



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
