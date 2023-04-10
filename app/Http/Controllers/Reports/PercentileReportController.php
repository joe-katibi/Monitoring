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
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class PercentileReportController extends Controller
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

        $percentileresults = [];

        $percentilecourse =[];

            $data['services']= $services;
            $data['reporttype']= $reporttype;
            $data['country']= $country;
            $data['category']= $category;
            $data['percentileresults']= $percentileresults;
            $data['percentilecourse']= $percentilecourse;


        return view('reports/percentile_report')->with($data);
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


        $agents = User::select('users.id','users.name')->where('position', '=', 'Agent')->first();


        $input = $request->all();

        //print_pre([$agents] , true);




        $type = $request->input('report_type_id');

        $service = $request->input('service');

       // $agent = $request->input('agent');

        $categoryname = $request->input('category');

        $countryname = $request->input('country');

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];

        $percentileresults = QuestionResults::select('question_results.id','question_results.results','question_results.question_no','question_results.marks','results.category','results.report_type_id',
                                                     'results.agent_name','fiber_welcome_questions.summarized','fiber_welcome_questions.category','fiber_welcome_questions.service','categories.category_name','services.service_name','users.country','countries.country_name','results.date_recorded','services.id as s_id')
                                                     ->join('results','results.id','=','question_results.results')
                                                     ->join('fiber_welcome_questions','fiber_welcome_questions.id','=','question_results.question_no')
                                                     ->join('categories','categories.id','=','results.category')
                                                     ->join('services','services.id','=','fiber_welcome_questions.service')
                                                     ->join('users','users.id','=','results.agent_name')
                                                     ->join('countries','countries.id','=','users.country')
                                                     ->where('results.report_type_id','=',$type)
                                                     ->where('users.country','=',$countryname)
                                                     ->where('users.services','=',$service )
                                                     ->where('results.category','=',$categoryname)
                                                     ->where('results.date_recorded','>=',$start_date)
                                                     ->where('results.date_recorded','<=',$end_date)
                                                    ->get();


     foreach ($percentileresults as $key => $value) {

                                    $createdAt = $value->date_recorded;

                                    $monthName = Carbon::parse($createdAt)->format('F');
                                     $value['monthName'] =  isset($createdAt)  ?  $monthName: '';

                                     $weekNumber = Carbon::parse($createdAt)->format('W');
                                     $weekNumberWithPrefix = "week " . $weekNumber;
                                     $value['weekNumberWithPrefix'] =  isset($createdAt)  ?  $weekNumberWithPrefix: '';


    }
        $percentilecourse =   exam_results::select('exam_results.id','exam_results.question_id','exam_results.marks_achieved','exam_results.conduct_id','exam_results.report_type_id','exam_results.created_by',
                                                   'exam_results.created_at','conduct_exams.course','conduct_exams.service','conduct_exams.category','conduct_exams.trainer_qa','report_types.type_name','services.service_name','categories.category_name','courses.course_name','countries.country_name','users.name','services.id as s_id')
                                                  ->join('conduct_exams','conduct_exams.id','=','exam_results.conduct_id')
                                                  ->join('user_categories','user_categories.category_id','=','conduct_exams.category')
                                                  ->join('users','users.id','=','user_categories.user_id')
                                                  ->join('report_types','report_types.id','=','exam_results.report_type_id')
                                                  ->join('categories','categories.id','=','conduct_exams.category')
                                                  ->join('services','services.id','=','conduct_exams.service')
                                                  ->join('courses','courses.id','=','conduct_exams.course')
                                                  ->join('countries','countries.id','=','users.country')
                                                  ->where('exam_results.report_type_id','=',$type)
                                                  ->where('users.country','=',$countryname)
                                                  ->where('conduct_exams.service','=',$service )
                                                  ->where('conduct_exams.category','=', $categoryname)
                                                  ->where('exam_results.created_at','>=',$start_date)
                                                 ->where('exam_results.created_at','<=',$end_date)
                                                  ->get()
                                                  ;

       foreach ($percentilecourse as $key => $value) {

                                                    $createdAt = $value->created_at;
                                                    $monthName = Carbon::parse($createdAt)->format('F');
                                                    $value['monthName'] =  isset($createdAt)  ?  $monthName: '';

                                                    $weekNumber = Carbon::parse($createdAt)->format('W');
                                                    $weekNumberWithPrefix = "week " . $weekNumber;
                                                    $value['weekNumberWithPrefix'] =  isset($createdAt)  ?  $weekNumberWithPrefix: '';


                                                }

    //  print_pre([$percentilecourse] , true);



        $data['services']= $services;
        $data['reporttype']= $reporttype;
        $data['country']= $country;
        $data['category']= $category;
        $data['percentileresults']= $percentileresults;
        $data['percentilecourse']= $percentilecourse;



        return view('reports/percentile_report')->with($data);
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
