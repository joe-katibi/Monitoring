<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\AlertForm;
use App\Models\Result;
use App\Models\QuestionResults;
use App\Models\Services;
use App\Models\Countries;
use App\Models\exam_results;
use App\Models\Categories;
use App\Models\ReportType;
use App\Models\LiveCalls;
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class LiveCallReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $services = Services::select('services.id','services.service_name')->get();

        $country = Countries::select('countries.id','countries.country_name')->get();

        $category = Categories::select('Categories.id','Categories.category_name')->get();

        $livecallreport = [];

        $data['services']= $services;
        $data['livecallreport']= $livecallreport;
        $data['country']= $country;
        $data['category']= $category;

        return view('reports/livecallsreports')->with($data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $services = Services::select('services.id','services.service_name')->get();

        $country = Countries::select('countries.id','countries.country_name')->get();

        $category = Categories::select('Categories.id','Categories.category_name')->get();

        $input = $request->all();

        $countryname = $request->input('country');

        $service = $request->input('service');

        $categoryname = $request->input('category');

        $supervisor = $request->input('supervisor');

        $agent = $request->input('agent');

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];


        $livecallreport = LiveCalls::select('live_calls.account_number','live_calls.recording_id','live_calls.date','live_calls.quality_analysts','live_calls.category','live_calls.supervisor',
                                            'live_calls.agent','live_calls.strength_summary','live_calls.gaps_summary','live_calls.voc_summary','categories.category_name','categories.service_id',
                                            'services.service_name','users.name','users.country','countries.country_name','gap_summaries.gap_name','summaries.summary_name','services.id as s_id',)
                                            ->join('categories','categories.id','=','live_calls.category')
                                            ->join('services','services.id','=','categories.service_id')
                                            ->join('user_categories','user_categories.category_id','=','live_calls.category')
                                            ->join('users','users.id','=','user_categories.user_id')
                                            ->join('countries','countries.id','=','users.country')
                                            ->join('gap_summaries','gap_summaries.id','=','live_calls.gaps_summary')
                                             ->join('summaries','summaries.id','=','live_calls.strength_summary')
                                            ->where('users.country','=',$countryname)
                                            ->where('users.services','=',$service )
                                            ->where('live_calls.category','=',$categoryname )
                                            ->where('live_calls.agent','=',$agent )
                                            ->where('live_calls.date','>=',$start_date)
                                            ->where('live_calls.date','<=',$end_date)
                                            ->get();


   foreach($livecallreport as $key => $value){

           $agentName = User::where('id','=', $value['agent'])->first();
            $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

            $SupervisorName = User::where('id','=', $value['supervisor'])->first();
            $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

            $qualityName = User::where('id','=', $value['quality_analysts'])->first();
            $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';


            $createdAt = $value->date;

            $monthName = Carbon::parse($createdAt)->format('F');
            $value['monthName'] =  isset($createdAt)  ?  $monthName: '';

            $weekNumber = Carbon::parse($createdAt)->format('W');
            $weekNumberWithPrefix = "week " . $weekNumber;
            $value['weekNumberWithPrefix'] =  isset($createdAt)  ?  $weekNumberWithPrefix: '';

        }


                                            $data['services']= $services;
                                            $data['livecallreport']= $livecallreport;
                                            $data['country']= $country;
                                            $data['category']= $category;


        // print_pre([$livecallreport] , true);

        return view('reports/livecallsreports')->with($data);
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
