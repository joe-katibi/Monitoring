<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\IssueGeneral;
use App\Models\SubIssueGeneral;
use Datatables;
use RealRashid\SweetAlert\Facades\Alert;

class GeneralIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $crm = IssueGeneral::all()->toArray();

        $data['crm'] = $crm ;



        return view('general_issue/general_view')->with($data);
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
        $input = $request->all();

        $request->validate([
            'name'=>'required',

        ]);

        try {
            DB::beginTransaction();

            $issuegeneral = new IssueGeneral();
            $issuegeneral->name =isset($input['name']) ? $input['name']:"";

            $issuegeneral->save();

            // log::channel('issuegeneral')->info('issue general Created :------> '.['200', $issuegeneral->toArray()]);

            DB::commit();
            toast('General Catergory successfully','success')->position('top-end');
            return redirect('general_issue/general_view');


        } catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
        }


    }
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGen(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'sub_name'=>'required',
            'issue_general_id'=>'required',
        ]);

        try {
            DB::beginTransaction();
            $subissuegeneral = new SubIssueGeneral();

            $subissuegeneral->sub_name = isset($input['sub_name'])? $input['sub_name']:"";
            $subissuegeneral->issue_general_id = isset($input['issue_general_id'])? $input['issue_general_id']:"";

            $subissuegeneral->save();

            // log::channel('subissuegeneral')->info('subissuegeneral Created : ------> ', ['200' , $subissuegeneral->toArray() ] );
            toast('General SubCatergory successfully','success')->position('top-end');
            DB::commit();

            return redirect('general_issue/general_view');

        } catch (\Throwable $e) {

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
        $showgeneral =SubIssueGeneral::select('sub_issue_generals.id','sub_issue_generals.sub_name','sub_issue_generals.issue_general_id','sub_issue_generals.created_at')
                                       ->join('issue_generals','issue_generals.id','=','sub_issue_generals.issue_general_id')
                                       ->Where('sub_issue_generals.issue_general_id','=',$id)
                                       ->get();

         $data['showgeneral'] = $showgeneral;

        return view('general_issue/general_show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $input = $request->all();
        $editIssuegeneral = IssueGeneral::findOrFail($id);
        $editIssuegeneral->name =isset($input['category']) ? $input['category']:"";
        $editIssuegeneral->save();
        return redirect()->back();
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

       /// dd( $input );

        $editsubissuegeneral= SubIssueGeneral::findOrFail($id);
        $editsubissuegeneral->sub_name =isset($input['edit_sub_call_tracker']) ? $input['edit_sub_call_tracker']:"";
        $editsubissuegeneral->save();
        return redirect()->back();
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
