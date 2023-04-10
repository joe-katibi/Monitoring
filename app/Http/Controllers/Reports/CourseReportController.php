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
use App\Models\Courses;
use App\Models\ReportType;
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class CourseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Services::select('services.id','services.service_name')->get();

        $course = Courses::select('courses.id','courses.course_name')->get();

        $country = Countries::select('countries.id','countries.country_name')->get();

        $coursereports =[];

        $data['services']= $services;
        $data['course']= $course;
        $data['country']= $country;
        $data['coursereports']= $coursereports;


        return view('reports/course_report')->with($data);
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

        $course = Courses::select('courses.id','courses.course_name')->get();

        $country = Countries::select('countries.id','countries.country_name')->get();

        $input = $request->all();



        $coursename = $request->input('course');

        $service = $request->input('service');

        $countryname = $request->input('country');

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];

       $coursereports =exam_results::select('exam_results.id','exam_results.question_id','exam_results.marks_achieved','exam_results.conduct_id','exam_results.report_type_id',
                                            'exam_results.created_by', 'exam_results.created_at','conduct_exams.course','conduct_exams.service','courses.course_name',
                                            'countries.country_name','conduct_exams.category','users.country','services.service_name','services.id as s_id')
                                            ->join('conduct_exams','conduct_exams.id','=','exam_results.conduct_id')
                                            ->join('courses','courses.id','=','conduct_exams.course')
                                            ->join('user_categories','user_categories.category_id','=','conduct_exams.category')
                                            ->join('users','users.id','=','user_categories.user_id')
                                            ->join('services','services.id','=','conduct_exams.service')
                                            ->join('countries','countries.id','=','users.country')
                                            ->where('users.country','=',$countryname)
                                            ->where('users.services','=',$service )
                                            ->where('conduct_exams.course','=',$coursename)
                                            ->where('exam_results.created_at','>=',$start_date)
                                            ->where('exam_results.created_at','<=',$end_date)
                                            ->get();

        foreach($coursereports as $key => $value){

                                                $createdAt = $value->created_at;

                                                $monthName = Carbon::parse($createdAt)->format('F');
                                                $value['monthName'] =  isset($createdAt)  ?  $monthName: '';

                                                $weekNumber = Carbon::parse($createdAt)->format('W');
                                                $weekNumberWithPrefix = "week " . $weekNumber;
                                                $value['weekNumberWithPrefix'] =  isset($createdAt)  ?  $weekNumberWithPrefix: '';

                                            }

                // print_pre([$coursereports] , true);

        $data['services']= $services;
        $data['course']= $course;
        $data['country']= $country;
        $data['coursereports']= $coursereports;


        return view('reports/course_report')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
