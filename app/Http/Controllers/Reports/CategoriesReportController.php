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

class CategoriesReportController extends Controller
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

        $categoryreport =[];

        $data['services']= $services;
        $data['country']= $country;
        $data['category']= $category;
        $data['categoryreport']= $categoryreport;

        return view('reports/categories_report')->with($data);
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

        $country = Countries::select('countries.id','country_name')->get();

        $category = Categories::select('Categories.id','Categories.category_name')->get();

        $input = $request->all();

        $service = $request->input('service');

        $categoryname = $request->input('category');

        $countryname = $request->input('country');

        $duration = $request->input('duration_unit');
        if ($duration == 'month') {
            $groupBy = 'month';
        } else {
            $groupBy = 'week';
        }

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];


        $categoryreport =Result::select('results.category','results.report_type_id','results.agent_name','results.id','results.final_results','results.date_recorded','categories.category_name','categories.id',
                                         'countries.country_name','services.service_name','users.category as u_cat', 'users.services','users.country','services.id as s_id'
                                           )
                                           ->join('categories','categories.id','=','results.category')
                                           ->join('user_categories','user_categories.category_id','=','results.category')
                                           ->join('users','users.id','=','user_categories.user_id')
                                           ->join('countries','countries.id','=','users.country')
                                           ->join('services','services.id','=','users.services')
                                           ->where('users.country','=',$countryname)
                                           ->where('users.services','=',$service )
                                           ->where('results.category','=',$categoryname)
                                           ->where('results.date_recorded','>=',$start_date)
                                           ->where('results.date_recorded','<=',$end_date)
                                          ->get();

        $groupedResults = $categoryreport->groupBy(function($item) use ($groupBy) {
                                       $date = Carbon::parse($item->date_recorded);
                                       $parameter = $item->category_name; // assuming "summarized" is the parameter name
                                      if ($groupBy == 'month') {
                                         return $date->format('F Y'); // Month, Year, and Parameter
                                    } else {
                                     return 'Week ' . $date->weekOfYear; // Week number and Parameter
                                    }
                                })->map(function($group) {
                                     $totalResults = $group->pluck('final_results')->sum();
                                     $average = $group->pluck('final_results')->avg();
                                     return [
                                     'average' => $average,
                                   'results' => $group,
                                ];
                            });


        $data['services']= $services;
        $data['country']= $country;
        $data['category']= $category;
        $data['categoryreport']= $categoryreport;
        $data['groupedResults'] = $groupedResults;

        return view('reports/categories_report')->with($data);
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
