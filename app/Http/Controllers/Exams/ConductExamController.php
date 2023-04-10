<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Models\ConductExam;
use App\Models\Categories;
use App\Models\ExamsQuestions;
use App\Models\Role;
use App\Models\User;
use App\Models\UserCategory;
use App\Models\Courses;
use App\Models\Services;
use App\Models\ExamStatus;
use App\Models\Answers;
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Jobs\ExamStatusJob;

class ConductExamController extends Controller
{

      //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['role:super-admin|admin|moderator|developer|quality-analysts|trainer']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['conduct'] = ConductExam::select('conduct_exams.id','conduct_exams.schedule_name','conduct_exams.time','conduct_exams.course',
                                      'conduct_exams.exam_name','conduct_exams.service','conduct_exams.category','conduct_exams.trainer_qa','conduct_exams.start_date','conduct_exams.completion_date','conduct_exams.created_at','exam_statuses.schedule_id','courses.course_name','users.name','categories.category_name','exam_statuses.status','user_categories.category_id')
                                      ->join('users','users.id','=','conduct_exams.trainer_qa')
                                      ->join('user_categories','user_categories.user_id','=','conduct_exams.trainer_qa')
                                      ->join('categories','categories.id','=','conduct_exams.category')
                                      ->join('services','services.id','=','conduct_exams.service')
                                      ->join('exam_statuses','exam_statuses.exam_id','=','conduct_exams.id')
                                      ->join('courses','courses.id','=','conduct_exams.course')
                                      ->get();


     //print_pre( $data , true  );

        return view('exams/conduct_exam', )->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $examquestion = ExamsQuestions ::all()->toArray();
       $conduct = ConductExam::all()->toArray();
       $category = Categories::all()->toArray();

       $trainer_id  = Role::select('roles.id',)->where('name', '=', 'Trainer')->orWhere('name','=','quality-analyst')->first();

       $trainer = User::select('users.name','users.id','model_has_roles.role_id')
                          ->join('model_has_roles','model_id','=','users.id')
                          ->where('model_has_roles.role_id','=',$trainer_id->id)
                          ->get();
       $course = Courses::all()->toArray();
       $service = Services::all()->toArray();


      // print_pre($trainer_id, true);

       $data['examquestion'] = $examquestion ;
       $data['conduct'] = $conduct ;
       $data['category'] = $category ;
       $data['trainer'] = $trainer ;
       $data['course'] = $course ;
       $data['service'] = $service ;

        return view('exams/schedule_exam')->with($data);
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

         //dd($input);


        try{

            DB::beginTransaction();
            $schedule = new ConductExam();
            $schedule->schedule_name =isset($input['schedule_name']) ? $input['schedule_name']:"";
            $schedule->time =isset($input['time']) ? $input['time']:"";
            $schedule->course =isset($input['course']) ? $input['course']:"";
            $schedule->exam_name =isset($input['exam_name']) ? $input['exam_name']:"";
            $schedule->service =isset($input['service']) ? $input['service']:"";
            $schedule->category =isset($input['category']) ? $input['category']:"";
            $schedule->trainer_qa =isset($input['trainer_qa']) ? $input['trainer_qa']:"";
            $schedule->start_date =isset($input['start_date']) ? $input['start_date']:"";
            $schedule->completion_date =isset($input['completion_date']) ? $input['completion_date']:"";
            $schedule->created_by= isset($input['created_by']) ? $input['created_by']:"";

          // dd($schedule, $input);




           $schedule->save();

            log::channel('schedule')->info('schedule exam Created : ------> ', ['200' , $schedule->toArray() ] );

            $schedule_id =ExamStatus::IdGenerator(new ConductExam, ' schedule->id ',5,'EXM');

            //$schedule_id = IdGenerator::generate(['table' => 'exam_statuses', ' schedule->id ','length' => 5, 'prefix' =>'EXM-']);

            $examstatus = new ExamStatus();
            $examstatus->schedule_id = $schedule_id;
            $examstatus->exam_id = $schedule->id;
            $examstatus->created_by = $schedule->created_by;
            $examstatus->status = '1';
            $examstatus->start_time = now();
            $examstatus->end_time = now()->addMinutes(30);

            log::channel('examstatus')->info('exam status Created : ------> ', ['200' , $examstatus->toArray() ] );

            $examstatus->save();

            // print( $examstatus);

            // dd($examstatus);

            DB::commit();
            toast('Exam Scheduled successfully','success')->position('top-end');
            return redirect('exams/conduct_exam');


            // dd($examstatus);

        //    print_pre( $examstatus , true  );

            // exit;


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

        $examshow = ConductExam::where('id','=',$id)->first();

        $viewquestion = ConductExam::find($id)
                             ->join('exam_statuses','exam_statuses.exam_id','=','conduct_exams.id')
                             ->join('courses','courses.id','=','conduct_exams.course')
                             ->join('services','services.id','=','conduct_exams.service')
                             ->join('categories','categories.id','=','conduct_exams.category')
                             ->join('users','users.id','=','conduct_exams.trainer_qa')
                             ->join('user_categories','user_categories.user_id','=','conduct_exams.trainer_qa')
                             ->join('exams_questions','exams_questions.course','=','conduct_exams.course')
                             ->join('answer_keys','answer_keys.question_id','=','exams_questions.id')

                             ->select('conduct_exams.id','conduct_exams.category','conduct_exams.time',
                                     'conduct_exams.course','conduct_exams.exam_name','conduct_exams.service','conduct_exams.category',
                                    'conduct_exams.trainer_qa','conduct_exams.start_date','conduct_exams.completion_date','conduct_exams.created_at',
                                    'exams_questions.question','exams_questions.id as q_id','answer_keys.choices','answer_keys.question_weight',
                                    'courses.course_name',
                                    'services.service_name','categories.category_name','users.name','exam_statuses.schedule_id','exam_statuses.status','user_categories.category_id')
                                    ->where('conduct_exams.id','=',$id)
                             ->first();

                //

                //print_pre(  $viewquestion, true);

        $data['viewquestion'] = $viewquestion;
        $data['examshow'] = $examshow;

        //  print_pre(  $data, true);
         //dd($viewquestion);

        return view('exams/view_conduct')->with($data);
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
        $examedit = ConductExam::find($id);
        $course = Courses::all()->toArray();
        $trainer = User::where('position','=','Trainer')->orWhere('position', '=','Quality Analyst')->get();
        $service = Services::all()->toArray();
        $category = Categories::all()->toArray();


        $data['conduct'] = ConductExam::select('conduct_exams.id','conduct_exams.category','conduct_exams.time','conduct_exams.course','conduct_exams.exam_name','conduct_exams.service',
        'conduct_exams.category','conduct_exams.trainer_qa','conduct_exams.start_date','conduct_exams.completion_date','conduct_exams.created_at','exam_statuses.schedule_id','courses.course_name',
        'users.name','categories.category_name','user_categories.category_id')
        ->join('users','users.id','=','conduct_exams.trainer_qa')
        ->join('categories','categories.id','=','conduct_exams.category')
        ->join('user_categories','user_categories.user_id','=','conduct_exams.trainer_qa')
        ->join('services','services.id','=','conduct_exams.service')
        ->join('exam_statuses','exam_statuses.exam_id','=','conduct_exams.id')
        ->join('courses','courses.id','=','conduct_exams.course')
      //   ->join('exams_questions','exams_questions.course','=','conduct_exams.course')
       ->where('conduct_exams.id','=',$id)
        ->get();

        $data['examedit'] = $examedit ;
        $data['course'] = $course ;
        $data['trainer'] = $trainer ;
        $data['service'] = $service ;
        $data['category'] = $category ;

        return view('exams/edit_conduct')->with($data);
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
