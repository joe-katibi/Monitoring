<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\AlertForm;
use App\Models\Result;
use App\Models\QuestionResults;
use App\Models\Services;
use App\Models\Countries;
use App\Models\exam_results;
use App\Models\Categories;
use App\Models\ReportType;
use App\Models\LiveCalls;
use App\Models\Courses;
use App\Models\ConductExam;
use App\Models\ExamsQuestions;
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;


class AdminDashboardController extends Controller
{



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $userId = auth()->id();

        $examTotalDone = DB::table('exam_results')->distinct('conduct_id')->count();

        $courseTotal =Courses::select('id')->count();  
        
        $totalExams =ConductExam::select('schedule_name')->count();

        $totalQuestions = ExamsQuestions::select('exams_questions')->count();

        $autoSlipping = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.qa_name')
        ->join('results','results.id','=','alert_forms.results_id')
        ->where('auto_status','=',1)
        ->count();
        $autoCompleted = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.qa_name')
                                    ->join('results','results.id','=','alert_forms.results_id')
                                    ->where('auto_status','=',3)
                                    ->count();
        $autoPending = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.qa_name')
                                    ->join('results','results.id','=','alert_forms.results_id')
                                    ->where('auto_status','=',2)
                                    ->count();      
        $autoTotal = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.qa_name')
                                    ->join('results','results.id','=','alert_forms.results_id')
                                    ->count();                     



        $data['examTotalDone'] = $examTotalDone;
        $data['courseTotal'] = $courseTotal;
        $data['totalExams'] = $totalExams;
        $data['totalQuestions'] = $totalQuestions;
        $data['autoSlipping'] = $autoSlipping;
        $data['autoPending'] = $autoPending;
        $data['autoCompleted'] = $autoCompleted;
        $data['autoTotal'] = $autoTotal;

        return view('admin/dashboard')->with($data);

    }

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
