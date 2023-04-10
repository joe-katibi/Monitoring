<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FiberWelcomeQuestion;
use App\Models\User;
use App\Models\Categories;
use App\Models\Services;
use App\Models\AlertForm;
use App\Models\Permission;
use Datatables;

class AgentAlertFormController extends Controller
{

      //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['role:super-admin|admin|moderator|developer|agent']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $alertfrom= AlertForm::all()->toArray();
        return view('agent/agent_alert_form',compact('alertfrom'));
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
    public function agent_alert_form(Request $request)
    {
        //
        $query =DB::table('alert_forms')->insert([

            'agent_name' => $request->input('agent_name2'),
            'agent_signature' => $request->input('agent_signature2'),
            'date_by_agent' => $request->input('date_by_agent2'),



        ]);

        return redirect('agent/agent_action');
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
