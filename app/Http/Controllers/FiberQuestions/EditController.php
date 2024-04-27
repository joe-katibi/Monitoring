<?php

namespace App\Http\Controllers\FiberQuestions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FiberWelcomeQuestion;
use App\Models\Categories;
use App\Models\Services;
use App\Models\User;
use App\Models\Permission;
use Datatables;
use RealRashid\SweetAlert\Facades\Alert;

class EditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = FiberWelcomeQuestion ::all()->toArray();
        $Category = Services ::all()->toArray();
        $Services = Categories::all()->toArray();

        // dd($Services);  exit;
       return view('admin/edit_parametors/Fiber/edit',compact('data','Category','Services'));



        //return view('admin/edit_parametors/Fiber/edit',$data);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        
        $request->validate([
            'number'=>'required',
            'question'=>'required',
            'summarized'=>'required',
            'yes'=>'required',
            'no'=>'required',
            'service'=>'required',
            'category'=>'required',

        ]);

        $updating =DB::table('fiber_welcome_questions')->where('id',$request->input('cid'))
        ->update([
            'number' => $request->input('number'),
            'question' => $request->input('question'),
            'summarized' => $request->input('summarized'),
            'yes' => $request->input('yes'),
            'no' => $request->input('no'),
            'service' => $request->input('service'),
            'category' => $request->input('category'),
            'created_by' => Auth::user()->id,


        ]);
        return redirect('admin/edit_parametors/Fiber/welcomequestionedit');

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
