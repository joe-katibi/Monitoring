<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Categories;
use App\Models\Permission;
use App\Models\Positions;
use Illuminate\Support\Facades\Hash;
use Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Courses;
use RealRashid\SweetAlert\Facades\Alert;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $Course = Courses::select('courses.id','courses.course_name','courses.service_id','courses.created_at','services.service_name')
                           ->join('services','services.id','=','courses.service_id')
                           ->get();

        return view('exams/course_view',compact('Course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $service =Services::all()->toArray();


        return view('exams/create_course',compact('service'));
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
            'course_name'=>'required',
            'service_id'=>'required',
        ]);

        try{

            DB::beginTransaction();
            $course = new Courses();
            $course->course_name = isset($input['course_name']) ? $input['course_name']:"";
            $course->service_id = isset($input['service_id']) ? $input['service_id']:"";
            $course->created_by = Auth::user()->id;
            $course->save();

            log::channel('course')->info('course Created : ------> ', ['200' , $course->toArray() ] );

            DB::commit();

            toast('Course Created successfully','success')->position('top-end');
            return to_route('course_view');

        }catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            alert()->error('ErrorAlert', 'Failed to Create Course')->footer('<span>Error code:</span>' . $e->getMessage());
            throw $e;
        }

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
        $course = Courses::find($id);
        return view('exams/edit_course',compact('course'));

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
            $course = Courses::findOrFail($id);
            $course->course_name = isset($input['course_name']) ? $input['course_name']:"";
            $course->created_by = Auth::user()->id;
            $course->save();
    
            log::channel('course')->info('course Created : ------> ', ['200' , $course->toArray() ] );
    
            DB::commit();
            toast('Course edited successfully','success')->position('top-end');

            return view('exams/edit_course',compact('course'));

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::info($e->getMessage() );
            alert()->error('ErrorAlert', 'Failed to Edit Course')->footer('<span>Error code:</span>' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
        $course->delete();
        toast('Course Deleted successfully','success')->position('top-end');
    }
    return to_route('course_view');
    }
}
