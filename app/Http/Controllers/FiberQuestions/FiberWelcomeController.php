<?php

namespace App\Http\Controllers\FiberQuestions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Categories;
use App\Models\Services;
use App\Models\FiberWelcomeQuestion;
use App\Models\User;
use App\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;

class FiberWelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $Category = Services ::all()->toArray();
       $Services = Categories::all()->toArray();
       return view('admin/edit_parametors/Fiber/welcomequestion',compact('Category','Services'));

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
    public function welcomequestionedit(Request $request)
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

    // try{

    //     DB::beginTransaction();
    //     $parameterquestions = new FiberWelcomeQuestion();
    //     $parameterquestions->number = isset($input['number']) ? $input['number']:"";
    //     $parameterquestions->question = isset($input['question']) ? $input['question']:"";
    //     $parameterquestions->summarized = isset($input['summarized']) ? $input['summarized']:"";
    //     $parameterquestions->yes = isset($input['yes']) ? $input['yes']:"";
    //     $parameterquestions->no = isset($input['no']) ? $input['no']:"";
    //     $parameterquestions->service = isset($input['service']) ? $input['service']:"";
    //     $parameterquestions->category = isset($input['category']) ? $input['category']:"";

    //     $parameterquestions->save();

    //     log::channel('parameterquestions')->info('parameter questions Created : ------> ', ['200' , $parameterquestions->toArray() ] );

    //     DB::commit();

    //     // return $request->input();


    // }catch (\Throwable $e) {

    //     DB::rollBack();
    //     Log::info($e->getMessage() );
    //     throw $e;
    // }

    // $query =DB::table('fiber_welcome_questions')->insert([
    //     'number' => $request->input('number'),
    //     'question' => $request->input('question'),
    //     'summarized' => $request->input('summarized'),
    //     'yes' => $request->input('yes'),
    //     'no' => $request->input('no'),
    //     'service' => $request->input('service'),
    //     'category' => $request->input('category'),


    // ]);
    // return $request->input();

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
    //     $row =DB::table('fiber_welcome_questions')->where('id',$id)->first();
    //     $data =[
    //         'info'=>$row
    //     ];

    //   return view('admin/edit_parametors/Fiber/edit',$data);
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
