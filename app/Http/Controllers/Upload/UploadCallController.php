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

       // Retrieves from the services table and returns them as a collection
        $services = Services::select('services.id','services.service_name')->get();

        // Retrieves all rows from the CallRatings table and converts them to an array
            $callrating = CallRatings::all()->toArray();

         // Retrieves specific columns from the UploadCalls table and joins it with the CallRatings, Categories, Services, and Users tables to retrieve additional information
            $upload = UploadCalls::select('upload_calls.agent_name','upload_calls.supervisor_name','upload_calls.call_category','upload_calls.qa_name',
                                   'upload_calls.call_rating','upload_calls.call_date','upload_calls.call_file','call_ratings.rating_name',
                                   'categories.service_id','services.service_name','categories.category_name','users.country','countries.country_name',
                                   )
                                  ->join('call_ratings','call_ratings.id','=','upload_calls.call_rating')
                                  ->join('categories','categories.id','=','upload_calls.call_category')
                                  ->join('services','services.id','=','categories.service_id')
                                  ->join('users','users.id','=','upload_calls.agent_name')
                                   ->join('countries','countries.id','=','users.country')
                                  ->get();

        // Loop through each element of the $upload array
    foreach($upload as $key => $value){

        $agentName = User::where('id','=', $value['agent_name'])->first();
        $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

        $SupervisorName = User::where('id','=', $value['supervisor_name'])->first();
        $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

        $qualityName = User::where('id','=', $value['qa_name'])->first();
        $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

    }

     // print_pre([$upload] , true);

        // Assigns the retrieved data to variables in an associative array called $data
             $data['callrating']=  $callrating;
            $data['upload']=  $upload;
            $data['services']=  $services;

         // Renders a view called 'call_saved/upload_calls' and passes it the $data array as a parameter
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
       // Get all the input data from the request
            $input = $request->all();


       // Validate that required fields are present and the call_file is a valid mp3 file
        //    $request->validate([
        //                     'service' => 'service',
        //                    'agent' => 'required',
        //                    'supervisor' => 'required',
        //                    'category' => 'required',
        //                    'qa_name' => 'required',
        //                    'call_rating' => 'required',
        //                    'call_date' => 'required',
        //                    'call_file' => 'required|mimes:mp3',
        //                    ]);

      // Check if the uploaded file is valid
            if ($request->hasFile('call_file') && $request->file('call_file')->isValid()) {
                // Get the file name and extension
                    $path = $_FILES['call_file']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                  }

          try {
                // Begin a transaction
                       DB::beginTransaction();

                    // Create a new UploadCalls model instance
                     $callrecord = new UploadCalls();

                 // Get the uploaded file and save it to the assets directory
                  $call_file = $request->file('call_file');
                   $filename = $call_file->getClientOriginalName();
                   $call_file->move('assets', $filename);

                  // Set the fields of the UploadCalls model instance from the input data
                     $callrecord->call_file = $filename;
                    $callrecord->agent_name = isset($input['agent']) ? $input['agent'] : "";
                     $callrecord->supervisor_name = isset($input['supervisor']) ? $input['supervisor'] : "";
                    $callrecord->call_category = isset($input['category']) ? $input['category'] : "";
                    $callrecord->qa_name = isset($input['qa_name']) ? $input['qa_name'] : "";
                    $callrecord->service_id = isset($input['service']) ? $input['service'] : "";
                     $callrecord->call_rating = isset($input['call_rating']) ? $input['call_rating'] : "";
                    $callrecord->call_date = isset($input['call_date']) ? $input['call_date'] : "";


                    // print_pre([$callrecord] , true);


                  // Save the UploadCalls model instance
               $callrecord->save();

                  // Log the creation of the call record
                 log::channel('callrecord')->info('call record Created : ------> ', ['200' , $callrecord->toArray() ] );

                // Commit the transaction
                 DB::commit();

                // Display a success message
                toast('Audio Uploaded Successfully','success')->position('top-end');

                 // Redirect back to the previous page
                 return redirect()->back();

     } catch (\Throwable $e) {
                 // Rollback the transaction on error and display an error message
               DB::rollBack();
                Log::info($e->getMessage());
                  alert()->error('ErrorAlert', 'Uplaod Failed')->footer('<span>Error code:</span>' . $e->getMessage());
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
