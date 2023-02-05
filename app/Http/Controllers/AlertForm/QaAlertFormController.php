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
use App\Models\Permission;
use Datatables;

class QaAlertFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('quality_analyst/qa_agent_alert_form');
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
    public function qa_agent_alert_form(Request $request)
    {

        $input = $request->all();

           // print_pre( $input , true);

        try{

            DB::beginTransaction();

            $agentalertfrom = new AlertForm();
            $agentalertfrom->title = isset($input['title']) ? $input['title'] : "";
            $agentalertfrom->date = isset($input['date']) ? $input['date'] :"";
            $agentalertfrom->agent_name = isset($input['agent_name']) ? $input['agent_name'] :"";
            $agentalertfrom->supervisor_name = isset($input['supervisor_name']) ? $input['supervisor_name']:"";
            $agentalertfrom->qa_name = isset($input['qa_name']) ? $input['qa_name']:"";
            $agentalertfrom->description = isset($input['description']) ? $input['description']:"";
            $agentalertfrom->fatal_error =isset($input['fatal_error']) ? $input['fatal_error']:"";
            $agentalertfrom->supervisor_comment = issest($input['supervisor_comment']) ? $input['supervisor_comment']:"";
            $agentalertfrom->qa_signature = issest($input['qa_signature']) ? $input['qa_signature']:"";
            $agentalertfrom->date_by_qa = issest($input['date_by_qa']) ? $input['date_by_qa']:"";
            $agentalertfrom->supervisor_signature = isset($input['supervisor_signature']) ? $input['supervisor_signature']:"";
            $agentalertfrom->date_by_supervisor = isset($input['date_by_supervisor']) ? $input['date_by_supervisor']:"";
            $agentalertfrom->agent_signature = issest($input['agent_signature']) ? $input['agent_signature']:"";
            $agentalertfrom-> date_by_agent -issest($input['date_by_agent']) ? $input['date_by_agent']:"";

            // print_pre( $agentalertfrom , true);

            $agentalertfrom->save();

            log::channel('agentalertfrom')->info('agent alert from Created : ------> ', ['200' , $agentalertfrom->toArray() ] );

            DB::commit();

            return redirect('results/Fiber/fiber_welcome_results');


        }catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
        }


        // $query =DB::table('alert_forms')->insert([
        //     'title' => $request->input('title'),
        //     'date' => $request->input('date'),
        //     'agent_name' => $request->input('agent_name'),
        //     'supervisor_name' => $request->input('supervisor_name'),
        //     'qa_name' => $request->input('qa_name'),
        //     'description' => $request->input('description'),
        //     'fatal_error' => $request->input('fatal_error'),
        //     'supervisor_comment' => $request->input('supervisor_comment'),
        //     'qa_signature' => $request->input('qa_signature'),
        //     'date_by_qa' => $request->input('date_by_qa2'),
        //     'supervisor_signature' => $request->input('supervisor_signature2'),
        //     'date_by_supervisor' => $request->input('date_by_supervisor2'),
        //     'agent_signature' => $request->input('agent_signature2'),
        //     'date_by_agent' => $request->input('date_by_agent2'),




        // ]);

        // return redirect('results/Fiber/fiber_welcome_results');
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
