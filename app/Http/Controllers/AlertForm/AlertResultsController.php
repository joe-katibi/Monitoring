<?php

namespace App\Http\Controllers\AlertForm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Role;
use App\Models\User;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Categories;
use App\Models\AlertForm;
use Carbon\Carbon;

class AlertResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Categories::select('Categories.id','Categories.category_name',)->get();

        $agentRole_id = Role::select('roles.id',)->where('name', '=', 'Agent')->first();

        $user_id = auth()->user()->id;

          // Get the authenticated user's ID
          $userId = auth()->id();

          $userlogged = User::select('users.name','users.id',)->where('users.id','=',$userId)->first();

        $supervisorlogged = Role::select('roles.id',)->where('name', '=', 'team-leader')->first();

        $agentlogged = Role::select('roles.id',)->where('name', '=', 'Agent')->first();

        $qualitylogged = Role::select('roles.id',)->where('name', '=', 'quality-analyst')->first();

        $trainierlogged = Role::select('roles.id',)->where('name', '=', 'trainer')->first();

        $agents = User::select('users.name','users.id','model_has_roles.role_id')
                        ->join('model_has_roles','model_id','=','users.id')
                       ->where('model_has_roles.role_id','=',$agentRole_id->id)
                        ->get();

        $viewalert = [];

              $data['viewalert']  = $viewalert;
              $data['category']  = $category;
              $data['agents']  = $agents;
              $data['user_id']  = $user_id;
              $data['supervisorlogged']  = $supervisorlogged;
              $data['agentlogged']  = $agentlogged;
              $data['qualitylogged']  = $qualitylogged;
              $data['trainierlogged']  = $trainierlogged;
              $data['userlogged']=$userlogged;



        return view('alert_forms/alert_forms_view')->with($data);
    }


    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $category = Categories::select('Categories.id','Categories.category_name')->get();

        $agentRole_id = Role::select('roles.id',)->where('name', '=', 'Agent')->first();

        $user_id = auth()->user()->id;

        $supervisorlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'team-leader')->first();

        $agentlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'Agent')->first();

        $qualitylogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'quality-analyst')->first();

        $trainierlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'trainer')->first();



        $agents = User::select('users.name','users.id','model_has_roles.role_id')
                        ->join('model_has_roles','model_id','=','users.id')
                       ->where('model_has_roles.role_id','=',$agentRole_id->id)
                        ->get();


        $input = $request->all();


        $agent = $request->input('agent');

        $categoryname = $request->input('category');

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];

        $viewalert = AlertForm::select('alert_forms.id','alert_forms.title','alert_forms.created_at','alert_forms.agent_name','categories.category_name',
                                 'alert_forms.supervisor_name','alert_forms.qa_name','alert_forms.description','alert_forms.fatal_error',
                                 'alert_forms.supervisor_comment','alert_forms.qa_signature','alert_forms.date_by_qa','alert_forms.supervisor_signature',
                                'alert_forms.date_by_supervisor','alert_forms.agent_signature','alert_forms.date_by_agent','alert_forms.auto_status','alert_forms.results_id','results.category')
                                 ->join('results','results.id','=','alert_forms.results_id')
                                 ->join('categories','categories.id','=','results.category')
                                 ->where('alert_forms.agent_name','=',$agent)
                                 //->where('results.category','=',$categoryname)
                                 ->where('alert_forms.created_at','>=',$start_date)
                                 ->where('alert_forms.created_at','<=',$end_date)
                                   ->get();

      foreach($viewalert as $key => $value){

                                    $agentName = User::where('id','=', $value['agent_name'])->first();
                                    $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                                    $SupervisorName = User::where('id','=', $value['supervisor_name'])->first();
                                    $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                                    $qualityName = User::where('id','=', $value['qa_name'])->first();
                                    $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

                                }

        $data['category']  = $category;
        $data['viewalert']  = $viewalert;
        $data['agents']  = $agents;
        $data['user_id']  = $user_id;
        $data['supervisorlogged']  = $supervisorlogged;
        $data['agentlogged']  = $agentlogged;
        $data['qualitylogged']  = $qualitylogged;
        $data['trainierlogged']  = $trainierlogged;

        return view('alert_forms/alert_forms_view')->with($data);
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
