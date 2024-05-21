<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FiberWelcomeQuestion;
use App\Models\User;
use App\Models\Role;
use App\Models\AlertForm;
use App\Models\Result;
use App\Models\QuestionResults;
use App\Models\Permission;
use App\Models\exam_results;
use App\Models\Positions;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Categories;
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
use Illuminate\Support\Facades\Auth;

class GlobalReportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

         $services = Services::All()->toArray();

        $reporttype = ReportType::All()->toArray();
         $country = Countries::All()->toArray();

         $auditresults = [];

         $examresults = [];

             $data['auditresults']= $auditresults;
             $data['examresults']= $examresults;
             $data['reporttype']= $reporttype;
             $data['services']= $services;
             $data['country']= $country;


        return view('reports/global_report')->with($data);
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

        $input = $request->all();

        $type = $request->input('report_type_id');

        $service = $request->input('service');

        $countryname = $request->input('country');

        $services = Services::All()->toArray();

        $reporttype = ReportType::All()->toArray();

        $country = Countries::All()->toArray();

        $duration = $request->input('duration_unit');
        if ($duration == 'month') {
            $groupBy = 'month';
        } else {
            $groupBy = 'week';
        }

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];

        $auditresults = User::select('users.id','users.country','users.name','users.services','services.service_name', 'results.date_recorded','categories.category_name',
            'countries.country_name','results.final_results', 'results.report_type_id', 'results.created_at','report_types.id','report_types.type_name'
        )
            ->join('services','services.id','=','users.services')
            ->join('user_categories','user_categories.user_id','=','users.id')
            ->join('categories','categories.id','=','user_categories.category_id')
            ->join('results','results.category','=','user_categories.category_id')
            ->join('countries','countries.id','=','users.country')
            ->join('report_types','report_types.id','=','results.report_type_id')
            ->where('users.country','=',$countryname)
            ->where('users.services','=',$service )
            ->where('results.report_type_id','=',$type)
            ->where('results.date_recorded','>=',$start_date)
            ->where('results.date_recorded','<=',$end_date)
            ->get();

        $groupedResults = $auditresults->groupBy(function($item) use ($groupBy) {
            $date = Carbon::parse($item->date_recorded);
            if ($groupBy == 'month') {
                return $date->format('F Y'); // Month and Year
            } else {
                return 'Week ' . $date->weekOfYear . ' ' . $date->year;
            }
        })->map(function($group) {
            $totalResults = $group->pluck('final_results')->sum();
            $average = $group->pluck('final_results')->avg();
            return [
                'average' => $average,
                'results' => $group,
            ];
        });

         $examresults =exam_results::select('exam_results.marks_achieved','exam_results.conduct_id','exam_results.report_type_id','exam_results.created_by','exam_results.created_at','conduct_exams.id',
                                            'conduct_exams.course','conduct_exams.exam_name','conduct_exams.service','conduct_exams.category','conduct_exams.trainer_qa','conduct_exams.completion_date','conduct_exams.created_by','report_types.type_name','users.name','users.services','users.country','services.service_name','countries.country_name','categories.category_name','services.service_name','courses.course_name',
                                         )
                                         ->join('conduct_exams','conduct_exams.id','=','exam_results.conduct_id')
                                         ->join('report_types','report_types.id','=','exam_results.report_type_id')
                                         ->join('user_categories','user_categories.category_id','=','conduct_exams.category')
                                         ->join('users','users.id','=','user_categories.user_id')
                                         ->join('services','services.id','=','conduct_exams.service')
                                         ->join('countries','countries.id','=','users.country')
                                         ->join('courses','courses.id','=','conduct_exams.course')
                                         ->join('categories','categories.id','=','conduct_exams.category')
                                        ->where('exam_results.report_type_id','=',$type)
                                        ->where('users.country','=',$countryname)
                                        ->where('users.services','=',$service )
                                        ->where('exam_results.created_at','>=',$start_date)
                                        ->where('exam_results.created_at','<=',$end_date)
                                      //->where('exam_results.created_by','=',$agents[0]['id'])
                                          ->get();

        $groupedResultsExam = $examresults->groupBy(function($item) use ($groupBy) {
                                        $date = Carbon::parse($item->created_at);
                                            if ($groupBy == 'month') {
                                                return $date->format('F Y'); // Month and Year
                                            } else {
                                                return 'Week ' . $date->weekOfYear . ' ' . $date->year;//Week number
                                            }
                                        })->map(function($group) {
                                            $totalResults = $group->pluck('marks_achieved')->sum();
                                            $average = $group->pluck('marks_achieved')->avg();
                                            return [
                                                'average' => $average,
                                                'results' => $group,
                                            ];
                                        });

        $data['auditresults']= $auditresults;
        $data['examresults']= $examresults;
        $data['reporttype']= $reporttype;
        $data['services']= $services;
        $data['country']= $country;
        $data['groupBy']=$groupBy;
        $data['groupedResults'] = $groupedResults;
        $data['groupedResultsExam'] = $groupedResultsExam;

        return view('reports/global_report')->with($data);

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
