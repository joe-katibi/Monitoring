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

class AutoFailReportController extends Controller
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


        $autofailreports = [];

            $data['services']= $services;
            $data['autofailreports']= $autofailreports;
            $data['country']= $country;
            $data['category']= $category;


        return view('reports/auto_fail_report')->with($data);
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

        $agentRole_id = Role::select('roles.id',)->where('name', '=', 'Agent')->first();
       // $agents = User::select('users.id','users.name')->where('position', '=', 'Agent')->first();

        $agents = User::select('users.id','users.name','model_has_roles.role_id','model_has_roles.model_id')->join('model_has_roles','model_has_roles.model_id','=','users.id')
                               ->where('model_has_roles.role_id','=',$agentRole_id->id)->first();

        $supervisorRole_id = Role::select('roles.id',)->where('name', '=', 'team-leader')->first();
        //$supervisor =  User::select('users.id','users.name')->where('position', '=', 'Supervisor')->first();
        $supervisor = User::select('users.id','users.name','model_has_roles.role_id','model_has_roles.model_id')->join('model_has_roles','model_has_roles.model_id','=','users.id')
                               ->where('model_has_roles.role_id','=',$supervisorRole_id->id)->first();

      //  $qa = User::select('users.id','users.name')->where('position', '=', 'Quality Analyst')->first();
        $qaRole_id = Role::select('roles.id',)->where('name', '=', 'quality-analyst')->first();
        $qa = User::select('users.id','users.name','model_has_roles.role_id','model_has_roles.model_id')->join('model_has_roles','model_has_roles.model_id','=','users.id')
                               ->where('model_has_roles.role_id','=',$qaRole_id->id)->first();


       // $trainer = User::select('users.id','users.name')->where('position', '=', 'Trainer')->first();
        $trainerRole_id = Role::select('roles.id',)->where('name', '=', 'trainer')->first();
        $trainer = User::select('users.id','users.name','model_has_roles.role_id','model_has_roles.model_id')->join('model_has_roles','model_has_roles.model_id','=','users.id')
                               ->where('model_has_roles.role_id','=',$trainerRole_id->id)->first();

        $input = $request->all();

      // print_pre($input , true);


        $service = $request->input('service');

        $categoryname = $request->input('category');

        $countryname = $request->input('country');

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];

        $autofailreports = AlertForm::select('alert_forms.agent_name','alert_forms.supervisor_name','alert_forms.qa_name','alert_forms.auto_status','alert_forms.created_at','alert_forms.results_id',
                                         'users.name','users.country','users.services','users.category','countries.country_name','services.service_name','categories.category_name', 'results.customer_account','results.category','services.id as s_id','users.id as user_id',)
                                         ->join('users','users.id','=','alert_forms.agent_name')
                                         ->join('countries','countries.id','=','users.country')
                                         ->join('user_categories','user_categories.user_id','=','users.id')
                                         ->join('categories','categories.id','=','user_categories.category_id')
                                         ->join('services','services.id','=','users.services')
                                         ->join('results','results.id','=','alert_forms.results_id')
                                         ->where('users.country','=',$countryname)
                                          ->where('users.services','=',$service )
                                         // ->where('results.category','=',$categoryname)
                                         ->where('results.date_recorded','>=',$start_date)
                                         ->where('results.date_recorded','<=',$end_date)
                                        // ->where('alert_forms.agent_name','=', $agents->id )
                                       //  ->where('alert_forms.supervisor_name','=',$supervisor->id)
                                        // ->where('alert_forms.qa_name','=',$qa->id )
                                         ->get();


        //print_pre([$autofailreports] , true);


        foreach($autofailreports as $key => $value){

            $agentName = User::where('id','=', $value['agent_name'])->first();
            $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

            $SupervisorName = User::where('id','=', $value['supervisor_name'])->first();
            $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

            $qualityName = User::where('id','=', $value['qa_name'])->first();
            $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

            $createdAt = $value->created_at;

            $monthName = Carbon::parse($createdAt)->format('F');
            $value['monthName'] =  isset($createdAt)  ?  $monthName: '';

            $weekNumber = Carbon::parse($createdAt)->format('W');
            $weekNumberWithPrefix = "week " . $weekNumber;
            $value['weekNumberWithPrefix'] =  isset($createdAt)  ?  $weekNumberWithPrefix: '';

        }


            $data['services']= $services;
            $data['autofailreports']= $autofailreports;
            $data['country']= $country;
            $data['category']= $category;

        

        return view('reports/auto_fail_report')->with($data);
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
