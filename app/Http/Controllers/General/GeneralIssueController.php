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

        // dd($data);


        return view('general_issue/general_view')->with($data);
    }

    Public function genfetcher(Request $request)

    {

        $data ['sub_general'] = SubIssueGeneral::Where('issue_general_id','=',$request->id)->get(['sub_name','id']);

        // dd($data);
        return response()->json($data);



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

            // dd($issuegeneral);

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

        //dd($input);

        $request->validate([
            'sub_name'=>'required',
            'issue_general_id'=>'required',
        ]);

        // dd($input);
        try {
            DB::beginTransaction();
            $subissuegeneral = new SubIssueGeneral();

            $subissuegeneral->sub_name = isset($input['sub_name'])? $input['sub_name']:"";
            $subissuegeneral->issue_general_id = isset($input['issue_general_id'])? $input['issue_general_id']:"";

            // dd($subissuegeneral);

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

        $showgeneral = IssueGeneral::select('issue_generals.id','issue_generals.name','sub_issue_generals.sub_name','sub_issue_generals.issue_general_id')
                                    ->join('sub_issue_generals','sub_issue_generals.issue_general_id','=','issue_generals.id')
                                    ->Where('issue_generals.id','=',$id)
                                    ->first()
                                    ;
         $data['showgeneral'] = $showgeneral;

        //  dd($data);

        return view('general_issue/general_show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('general_issue/general_edit');
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
