<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\FiberWelcomeQuestion;
use App\Models\User;
use App\Models\Categories;
use App\Models\Services;
use App\Models\AlertForm;
use App\Models\Permission;
use Datatables;
use Carbon\Carbon;

class AgentAlertFormController extends Controller
{

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
               $showalert = AlertForm::select('alert_forms.id','alert_forms.title','alert_forms.date','alert_forms.agent_name',
                                'alert_forms.supervisor_name','alert_forms.qa_name','alert_forms.description','alert_forms.fatal_error',
                                'alert_forms.supervisor_comment','alert_forms.qa_signature','alert_forms.date_by_qa','alert_forms.supervisor_signature',
                                'alert_forms.date_by_supervisor','alert_forms.agent_signature','alert_forms.date_by_agent','alert_forms.auto_status')
                         ->where( 'alert_forms.id','=',$id)
                         ->get();



         foreach ($showalert as $key => $value) {

            $agentName = User::where('id','=', $value['agent_name'])->first();
            $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

            $SupervisorName = User::where('id','=', $value['supervisor_name'])->first();
            $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

            $qualityName = User::where('id','=', $value['qa_name'])->first();
            $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';
         }

         $agentSignatureUrl = null;

         return view('agent/agent_alert_form',compact('showalert','agentSignatureUrl'));
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
        $input = $request->all();

        try {
            DB::beginTransaction();
            $updatealert = AlertForm::where('id','=',$id)->first();
            $updatealert->agent_signature = isset($input['agent_signature']) ? $input['agent_signature']:"";
            $updatealert->date_by_agent = isset($input['date_agent']) ? Carbon::parse($input['date_agent'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
            $updatealert->auto_status = '3';

            $updatealert->save();


            log::channel('agentSignAlertForm')->info('agent signed alert form : ------> ', ['200' , $updatealert->toArray() ] );

            DB::commit();

            return redirect('/alert_forms/alert_view_full/'.$updatealert->id);


        } catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
            toast('Something Went Wrong','warning')->position('top-end');
        }
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
