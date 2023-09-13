<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\AlertForm;
use App\Models\Result;
use App\Models\QuestionResults;
use App\Models\Permission;
use App\Models\Positions;
use App\Models\Services;
use App\Models\Countries;
use App\Models\exam_results;
use App\Models\Categories;
use App\Models\ConductExam;
use App\Models\IssueGeneral;
use App\Models\CallTracker;
use App\Models\SubCallTracker;
use App\Models\Summary;
use App\Models\ReportType;
use App\Models\LiveCalls;
use App\Models\LiveCalls_results;
use App\Models\GapSummaries;
use App\Models\VoCSummaries;
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class ProductivityReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Services::select('services.id','services.service_name')->get();

        $reporttype = ReportType::select('report_types.id','report_types.type_name')->get();

        $country = Countries::select('countries.id','countries.country_name')->get();

        $category = Categories::select('Categories.id','Categories.category_name')->get();

        $agents = User::select('users.name','users.id')->where('position', '=', 'Agent')->get();

        $productivityresults = [];

        $productivityexams =[];

            $data['services']= $services;
            $data['reporttype']= $reporttype;
            $data['country']= $country;
            $data['category']= $category;
            $data['agents']= $agents;
            $data['productivityresults']= $productivityresults;
            $data['productivityexams']= $productivityexams;

        return view('reports/productivity')->with($data);
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

        $reporttype = ReportType::select('report_types.id','report_types.type_name')->get();

        $country = Countries::select('countries.id','countries.country_name')->get();

        $category = Categories::select('Categories.id','Categories.category_name')->get();

        $agents = User::select('users.id','users.name')->where('position', '=','Agent')->first();


        $input = $request->all();


        //print_pre([$input] , true);

        $type = $request->input('report_type_id');

        $service = $request->input('service');

        $agent = $request->input('agent');

        $supervisor = $request->input('supervisor');

        $categoryname = $request->input('category');

        $countryname = $request->input('country');

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];


        $productivityresults =Result::select('results.id','results.report_type_id','results.supervisor','results.agent_name','results.quality_analysts','results.date_recorded','results.customer_account',
                                             'results.recording_id','results.final_results','results.category','results.status','users.category','users.name','users.services','users.country','services.service_name','services.id as s_id', 'categories.category_name','countries.country_name','report_types.type_name'
                                      )
                                      ->join('user_categories','user_categories.category_id','=','results.category')
                                      ->join('users','users.id','=','user_categories.user_id')
                                      ->join('categories','categories.id','=','user_categories.category_id')
                                      ->join('services','services.id','=','users.services')
                                      ->join('countries','countries.id','=','users.country')
                                      ->join('report_types','report_types.id','=','results.report_type_id')
                                      ->where('results.report_type_id','=',$type)
                                      ->where('users.country','=',$countryname)
                                      ->where('users.services','=',$service )
                                      ->where('results.category','=',$categoryname)
                                      ->where('results.agent_name','=',$agent)
                                     ->where('results.supervisor','=',$supervisor)
                                      ->where('results.date_recorded','>=',$start_date)
                                      ->where('results.date_recorded','<=',$end_date)
                                     ->get();

     foreach($productivityresults as $key => $value){

                                        $autoFail = AlertForm::select('alert_forms.id','alert_forms.results_id')
                                        ->where('results_id','=',$value['id'] )->first();
                                        $value['autoFail'] =  isset($autoFail)  ?  $autoFail->results_id : '';

                                        $agentName = User::where('id','=', $value['agent_name'])->first();
                                        $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                                        $SupervisorName = User::where('id','=', $value['supervisor'])->first();
                                        $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                                        $qualityName = User::where('id','=', $value['quality_analysts'])->first();
                                        $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

                                        $createdAt = $value->date_recorded;

                                        $monthName = Carbon::parse($createdAt)->format('F');
                                        $value['monthName'] =  isset($createdAt)  ?  $monthName: '';

                                        $weekNumber = Carbon::parse($createdAt)->format('W');
                                        $weekNumberWithPrefix = "week " . $weekNumber;
                                        $value['weekNumberWithPrefix'] =  isset($createdAt)  ?  $weekNumberWithPrefix: '';

                                    }

                                    // print_pre([$productivityresults] , true);

         $productivityexams  = exam_results::select('exam_results.marks_achieved','exam_results.conduct_id','exam_results.report_type_id','exam_results.created_by','exam_results.created_at','conduct_exams.id',
                                                   'conduct_exams.course','conduct_exams.exam_name','conduct_exams.service','conduct_exams.category','conduct_exams.trainer_qa','conduct_exams.completion_date','conduct_exams.created_by','report_types.type_name','users.category','users.name','users.services','users.country','services.service_name','countries.country_name','categories.category_name','services.service_name','courses.course_name','services.id as s_id'
                                                    )
                                              ->join('conduct_exams','conduct_exams.id','=','exam_results.conduct_id')
                                              ->join('report_types','report_types.id','=','exam_results.report_type_id')
                                              ->join('user_categories','user_categories.category_id','=','conduct_exams.category')
                                              ->join('users','users.id','=','user_categories.user_id')
                                           //   ->join('categories','categories.id','=','user_categories.category_id')
                                              ->join('services','services.id','=','conduct_exams.service')
                                              ->join('countries','countries.id','=','users.country')
                                              ->join('courses','courses.id','=','conduct_exams.course')
                                              ->join('categories','categories.id','=','conduct_exams.category')
                                              ->where('exam_results.report_type_id','=',$type)
                                              ->where('users.country','=',$countryname)
                                              ->where('users.services','=',$service )
                                              ->where('exam_results.created_at','>=',$start_date)
                                              ->where('exam_results.created_at','<=',$end_date)
                                               ->where('exam_results.created_by','=',$agent)
                                              ->get();



      foreach($productivityexams as $key => $value){


        $agentName = User::where('id','=', $value['created_by'])->first();
        $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';


        $SupervisorName  = User::where('position', '=', 'Supervisor')->where('category','=',$value['category'])->first();
        $value['SupervisorName'] =  isset($SupervisorName )  ?  $SupervisorName->name : '';


        $trainerName = User::where('id','=', $value['trainer_qa'])->first();
        $value['trainerName'] =  isset($trainerName)  ?  $trainerName->name : '';

                                                    $createdAt = $value->created_at;

                                                    $monthName = Carbon::parse($createdAt)->format('F');
                                                    $value['monthName'] =  isset($createdAt)  ?  $monthName: '';

                                                    $weekNumber = Carbon::parse($createdAt)->format('W');
                                                    $weekNumberWithPrefix = "week " . $weekNumber;
                                                    $value['weekNumberWithPrefix'] =  isset($createdAt)  ?  $weekNumberWithPrefix: '';

                                                }

            $data['services']= $services;
            $data['reporttype']= $reporttype;
            $data['country']= $country;
            $data['category']= $category;
            $data['agents']= $agents;
            $data['productivityresults']= $productivityresults;
            $data['productivityexams']= $productivityexams;


             print_pre([$productivityexams] , true);


        return view('reports/productivity')->with($data);
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
