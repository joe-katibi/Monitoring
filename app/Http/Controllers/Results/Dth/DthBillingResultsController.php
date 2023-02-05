<?php

namespace App\Http\Controllers\Results\Dth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\FiberWelcomeQuestion;
use App\Models\User;
use App\Models\Role;
use App\Models\AlertForm;
use App\Models\Result;
use App\Models\QuestionResults;
use App\Models\Permission;
use App\Models\Positions;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Categories;
use Datatables;

class DthBillingResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //



            //  $question = FiberWelcomeQuestion::all()->toArray();

            $archived =DB::table('results')->where(function($query){
                $query->where('category','DTH Billing')
                ->where('id','2');})->get();
               //  $tittle = Categories::where('id', '=', $category)->first();





                $data['results_details'] = QuestionResults::get_results_details(89);
                $data['results_marks'] = QuestionResults::get_results_marks(89);
               //  $data['tittle'] = $tittle ;
              //  $data['question'] = QuestionResults::get_question(77);


               //  print_pre( [ $data['question']], true);


               //  echo "<pre>";
               //  print_r($data['results_marks']);
               //  exit;

                // dd($data);
        return view('results/Dth/dth_billing_results')->with($data);
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
