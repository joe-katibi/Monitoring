<?php

namespace App\Http\Controllers\AlertForm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\FiberWelcomeQuestion;
use App\Models\Categories;
use App\Models\Services;
use App\Models\AlertForm;
use App\Models\User;
use App\Models\UserCategory;
use App\Models\Permission;
use App\Models\Result;
use Datatables;
use Carbon\Carbon;
use App\Jobs\AutoFailStatusJob;
use PDF;
use Config;
// use Knp\Snappy\Pdf;

class QaAlertFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $qa_alert = Result::select('results.id','results.supervisor','results.agent_name','results.quality_analysts','results.date_recorded','results.category','results.customer_account',
                                   'results.recording_id','results.results','categories.category_name')
                                   ->join('user_categories','user_categories.category_id','=','results.category')
                                   ->join('categories','categories.id','=','results.category')
                                   ->where('results.id','=',$id)
                                   ->first();

         $agents = User::where('id','=', $qa_alert['agent_name'])->first();
         $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

         $supervisor = User::where('id','=', $qa_alert['supervisor'])->first();
         $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

         $qa = User::where('id','=', $qa_alert['quality_analysts'])->first();
         $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

         $status = AlertForm::select('auto_status')->first();

         $sectionId = 'section1';

         $supervisorSignatureUrl = null;

         $qualitySignatureUrl = null;

         $agentSignatureUrl = null;

        return view('alert_forms/qa_agent_alert_form',compact('qa_alert','agents','supervisor','qa','status','sectionId','supervisorSignatureUrl','qualitySignatureUrl','agentSignatureUrl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();

        try{

            DB::beginTransaction();

            $agentalertfrom = new AlertForm();

            $agentalertfrom->title = isset($input['title']) ? $input['title'] : "";
            $agentalertfrom->date = isset($input['date_auto']) ? Carbon::parse($input['date_auto'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
            $agentalertfrom->agent_name = isset($input['agent_name']) ? $input['agent_name'] :"";
            $agentalertfrom->supervisor_name = isset($input['supervisor_name']) ? $input['supervisor_name']:"";
            $agentalertfrom->qa_name = isset($input['qa_name']) ? $input['qa_name']:"";
            $agentalertfrom->description = isset($input['description']) ? $input['description']:"";
            $agentalertfrom->fatal_error =isset($input['fatal_error']) ? $input['fatal_error']:"";
            $agentalertfrom->supervisor_comment = isset($input['supervisor_comment']) ? $input['supervisor_comment']:"";
            $agentalertfrom->qa_signature =  $input['quality_signature'];
            $agentalertfrom->date_by_qa = isset($input['date_by_qa']) ? Carbon::parse($input['date_by_qa'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
            $agentalertfrom->supervisor_signature = $input['supervisor_signature'];
            $agentalertfrom->date_by_supervisor = isset($input['date_by_supervisor']) ? Carbon::parse($input['date_by_supervisor'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
            $agentalertfrom->agent_signature = $input['agent_signature'];
            $agentalertfrom-> date_by_agent =isset($input['date_by_agent']) ? Carbon::parse($input['date_by_agent'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
            $agentalertfrom->results_id = isset($input['results_id']) ? $input['results_id']:"";
            $agentalertfrom->category_id = isset($input['category_id']) ? $input['category_id']:"";
            $agentalertfrom->auto_status = '1';
            $agentalertfrom->created_by = Auth::user()->id;

            $agentalertfrom->save();

             // Dispatch the AuditJob to check the status of the Autofail
             AutoFailStatusJob::dispatch($agentalertfrom);

            log::channel('agentalertfrom')->info('agent alert from Created : ------> ', ['200' , $agentalertfrom->toArray() ] );

            DB::commit();

            return redirect('/alert_forms/alert_view_full/'.$agentalertfrom->id);


        }catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $showalert = AlertForm::select('alert_forms.id','alert_forms.title','alert_forms.date','alert_forms.agent_name',
                                     'alert_forms.supervisor_name','alert_forms.qa_name','alert_forms.description','alert_forms.fatal_error',
                                     'alert_forms.supervisor_comment','alert_forms.qa_signature','alert_forms.date_by_qa','alert_forms.supervisor_signature',
                                     'alert_forms.date_by_supervisor','alert_forms.agent_signature','alert_forms.date_by_agent','alert_forms.auto_status')
                              ->where( 'alert_forms.id','=',$id)
                              ->get();

            foreach($showalert as $key => $value){

                $agentName = User::where('id','=', $value['agent_name'])->first();
                $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                $SupervisorName = User::where('id','=', $value['supervisor_name'])->first();
                $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                $qualityName = User::where('id','=', $value['qa_name'])->first();
                $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';


            }

        $data['showalert']  = $showalert;

        return view('alert_forms/alert_view_full')->with($data);
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

         $supervisorSignatureUrl = null;

         return view('team_leader/tl_agent_alert_form',compact('showalert','supervisorSignatureUrl'));
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAlert(Request $request, $id )
    {
        $input = $request->all();

        try {
            DB::beginTransaction();
            $updatealert = AlertForm::where('id','=',$id )->first();
            $updatealert->supervisor_comment = isset($input['supervisor_comments']) ? $input['supervisor_comments']:"";
            $updatealert->supervisor_signature = isset($input['supervisor_signature']) ? $input['supervisor_signature']:"";
            $updatealert->date_by_supervisor = isset($input['date_supervisor']) ? Carbon::parse($input['date_supervisor'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
            $updatealert->auto_status = '2';
            $updatealert->created_by = Auth::user()->id;

            $updatealert->save();

            log::channel('supervisorSignAlertForm')->info('Supervisor signed alert form : ------> ', ['200' , $updatealert->toArray() ] );

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,AlertForm $autofail)
    {
        $autofail->update($request->all());

        // Dispatch the job to check the status of the audit
        dispatch(new AutoFailStatusJob($autofail));
    }

    public function generatePDF($id)
    {
         $showalert = AlertForm::select('alert_forms.id','alert_forms.title','alert_forms.date','alert_forms.agent_name',
                                     'alert_forms.supervisor_name','alert_forms.qa_name','alert_forms.description','alert_forms.fatal_error',
                                     'alert_forms.supervisor_comment','alert_forms.qa_signature','alert_forms.date_by_qa','alert_forms.supervisor_signature',
                                     'alert_forms.date_by_supervisor','alert_forms.agent_signature','alert_forms.date_by_agent','alert_forms.auto_status')
                              ->where( 'alert_forms.id','=',$id)
                              ->get();

            foreach($showalert as $key => $value){

                $agentName = User::where('id','=', $value['agent_name'])->first();
                $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                $SupervisorName = User::where('id','=', $value['supervisor_name'])->first();
                $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                $qualityName = User::where('id','=', $value['qa_name'])->first();
                $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';


            }

        $data = ['showalert' => $showalert];
        $pdf = PDF::loadView('alert_forms/pdf', $data); // Use a separate Blade view for PDF content

          // Set paper size to A4
         $pdf->setPaper('a4', 'portrait');

        return $pdf->download('alert_form.pdf');


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
