<?php

namespace App\Http\Controllers\QualityAnalyst;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FiberWelcomeQuestion;
use App\Models\User;
use App\Models\Permission;
use Datatables;
use App\Models\ReportType;
use App\Models\Categories;
use App\Models\Services;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Define an array of data with key 'fiber'
        $data['fiber'] = Services::select('services.id','services.service_name', 'categories.category_name', 'categories.id as category_id')
                        // Join the Categories table based on matching IDs
                        ->join('categories', 'categories.service_id' , '=' , 'services.id')
                        // Limit results to those with an ID equal to 1
                        ->where('services.id' , '=', 1)
                        ->get(); // Retrieve the results

        // Define an array of data with key 'dth'
        $data['dth'] = Services::select('services.id','services.service_name', 'categories.category_name', 'categories.id as category_id')
                  // Join the Categories table based on matching IDs
                        ->join('categories', 'categories.service_id' , '=' , 'services.id')
                  // Limit results to those with an ID equal to 1
                        ->where('services.id' , '=', 2)
                        ->get();

        return view('quality_analyst/category')->with($data);
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
