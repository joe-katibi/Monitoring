<?php

namespace App\Http\Controllers\FiberQuestions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\FiberWelcomeQuestion;
use App\Models\Categories;
use App\Models\Services;
use App\Models\User;
use App\Models\Permission;
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;



class fiberWelcomeEditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['list'] = Categories::select('categories.id','categories.category_name','categories.service_id')->get();

        return view('admin/edit_parametors/Fiber/welcomequestionedit',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       $Category = Services ::all()->toArray();
       $Services = Categories::all()->toArray();
       return view('admin/edit_parametors/Fiber/welcomequestion',compact('Category','Services'));
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
        'number'=>'required',
        'question'=>'required',
        'summarized'=>'required',
        'yes'=>'required',
        'no'=>'required',
        'service'=>'required',
        'category'=>'required',
    ]);

    try{

        DB::beginTransaction();
        $parameterquestions = new FiberWelcomeQuestion();
        $parameterquestions->number = isset($input['number']) ? $input['number']:"";
        $parameterquestions->question = isset($input['question']) ? $input['question']:"";
        $parameterquestions->summarized = isset($input['summarized']) ? $input['summarized']:"";
        $parameterquestions->yes = isset($input['yes']) ? $input['yes']:"";
        $parameterquestions->no = isset($input['no']) ? $input['no']:"";
        $parameterquestions->service = isset($input['service']) ? $input['service']:"";
        $parameterquestions->category = isset($input['category']) ? $input['category']:"";

        $parameterquestions->save();

        log::channel('parameterquestions')->info('parameter questions Created : ------> ', ['200' , $parameterquestions->toArray() ] );

        DB::commit();

        toast('Parameter created successfully','success')->position('top-end');
        return redirect('admin/edit_parametors/Fiber/welcomequestionedit');

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

         $data['list'] = FiberWelcomeQuestion::select('fiber_welcome_questions.*','services.service_name','categories.category_name')
       ->join('services','fiber_welcome_questions.service','=','services.id')
       ->join('categories','fiber_welcome_questions.category','=','categories.id')
       ->where('fiber_welcome_questions.category','=',$id)
       ->get();

         $data['total'] = FiberWelcomeQuestion::where('category', '=', $id)->sum('yes');

      // print_pre($total,true);
        return view('/admin/edit_parametors/Fiber/viewparameter',)->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {

        $input = $request->all();

        // dd($input);
        $item = FiberWelcomeQuestion::find($id)
                       ->join('categories','categories.id','=','fiber_welcome_questions.category')
                       ->join('services','services.id','=','fiber_welcome_questions.service')
                       ->select('fiber_welcome_questions.id','fiber_welcome_questions.number','fiber_welcome_questions.question','fiber_welcome_questions.summarized','fiber_welcome_questions.yes','fiber_welcome_questions.no','fiber_welcome_questions.service','fiber_welcome_questions.category','categories.category_name','services.service_name')
                       ->where('fiber_welcome_questions.id','=',$id)
                       ->first();
        $Category = Categories ::all()->toArray();
        $service = Services ::all()->toArray();

        $data[ 'Category'] = $Category;
        $data[ 'service'] = $service;
        $data['info']= $item ;


     return view('/admin/edit_parametors/Fiber/edit',)->with($data);


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
       // dd($input);  exit;

        try {

            DB::beginTransaction();
            $updating = FiberWelcomeQuestion::where('id','=',$id)->first();
            $updating->number = isset($input['number']) ? $input['number']:"";
            $updating->question = isset($input['question']) ? $input['question']:"";
            $updating->summarized = isset($input['summarized']) ? $input['summarized']:"";
            $updating->yes = isset($input['yes']) ? $input['yes']:"";
            $updating->no = isset($input['no']) ? $input['no']:"";
            $updating->service = isset($input['service']) ? $input['service']:"";
            $updating->category = isset($input['category']) ? $input['category']:"";

            // dd($updating); exit;

            $updating->save();

            //print_pre($updating,true);

            log::channel('updateparameter')->info('update parameter Created : ------> ', ['200' , $updating->toArray() ] );

            Alert::success('Successfully', 'Parameter updated');

             DB::commit();
            toast('Parameter edited successfully','success')->position('top-end');
            return redirect('admin/edit_parametors/Fiber/welcomequestionedit');

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
        $destroy =DB::table('fiber_welcome_questions')->where('id',$id)->delete();
        toast('Parameter delected Succeessfully','success')->position('top-end');
       // return redirect('admin/edit_parametors/Fiber/welcomequestionedit');
    }
}
