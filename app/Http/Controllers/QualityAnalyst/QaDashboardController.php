<?php

namespace App\Http\Controllers\QualityAnalyst;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

class QaDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userId = auth()->id();

        $auditSlipping = Result::select('status')->where('status','=',1)->count();

        $auditPending = Result::select('status')->where('status','=',2)->count();

        $auditCompleted = Result::select('status')->where('status','=',3)->count();

        $auditTotal = Result::select('status')->count();

        $autoSlipping = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.qa_name')
                                   ->join('results','results.id','=','alert_forms.results_id')
                                   ->where('auto_status','=',1)
                                   ->where('alert_forms.qa_name','=',$userId)
                                   ->count();

        $autoPending = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.qa_name')
                                  ->join('results','results.id','=','alert_forms.results_id')
                                  ->where('auto_status','=',2)
                                  ->where('alert_forms.qa_name','=',$userId)
                                  ->count();

        $autoCompleted = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.qa_name')
                                    ->join('results','results.id','=','alert_forms.results_id')
                                    ->where('auto_status','=',3)
                                    ->where('alert_forms.qa_name','=',$userId)
                                    ->count();

        $autoTotal = AlertForm::select('alert_forms.results_id','alert_forms.auto_status','results.id','alert_forms.qa_name')
                                    ->join('results','results.id','=','alert_forms.results_id')
                                    ->where('alert_forms.qa_name','=',$userId)
                                    ->count();

                                    $results = DB::table('results')->where('quality_analysts','=',$userId)->get();

                                    // Group the data by week/month and calculate the average of the "final_results" column
                                     $weeklyResults = $results->groupBy(function($result) {
                                          return \Carbon\Carbon::parse($result->created_at)->startOfWeek();
                                          })->map(function($group) {
                                     return $group->avg('final_results');
                                      });

                                    $monthlyResults = $results->groupBy(function($result) {
                                     return \Carbon\Carbon::parse($result->created_at)->startOfMonth();
                                    })->map(function($group) {
                                     return $group->avg('final_results');
                                    });

                                     // Create the data arrays for the graph
                                     $weeklyData = $weeklyResults->values();
                                     $weeklyLabels = $weeklyResults->keys()->map(function($date) {
                                     return Carbon::parse($date)->format('M d');
                                    })->values();

                                    $monthlyData = $monthlyResults->values();
                                    $monthlyLabels = $monthlyResults->keys()->map(function($date) {
                                     return Carbon::parse($date)->format('M Y');
                                     })->values();


        $data['auditSlipping'] = $auditSlipping;
        $data['auditPending'] = $auditPending;
        $data['auditCompleted'] = $auditCompleted;
        $data['auditTotal'] = $auditTotal;
        $data['autoSlipping'] = $autoSlipping;
        $data['autoPending'] = $autoPending;
        $data['autoCompleted'] = $autoCompleted;
        $data['autoTotal'] = $autoTotal;

        $data['weeklyData'] = $weeklyData;
        $data['weeklyLabels'] = $weeklyLabels;
        $data['monthlyData'] = $monthlyData;
        $data['monthlyLabels'] = $monthlyLabels;

        return view('quality_analyst/qadashboard')->with($data);
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
