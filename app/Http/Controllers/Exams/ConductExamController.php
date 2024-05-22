<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
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
use App\Models\AnswerKeys;
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Jobs\ExamStatusJob;

class ConductExamController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['conduct'] = ConductExam::select('conduct_exams.id','conduct_exams.schedule_name','conduct_exams.time','conduct_exams.course',
                                      'conduct_exams.exam_name','conduct_exams.service','conduct_exams.category','conduct_exams.trainer_qa',
                                      'conduct_exams.start_date','conduct_exams.completion_date','conduct_exams.created_at','exam_statuses.schedule_id',
                                      'courses.course_name','users.name','categories.category_name','exam_statuses.status',//'exams_questions.question',
                                      'exam_statuses.id as status_id'
                                      )
                                      ->join('users','users.id','=','conduct_exams.trainer_qa')
                                      ->join('categories','categories.id','=','conduct_exams.category')
                                      ->join('services','services.id','=','conduct_exams.service')
                                      ->join('exam_statuses','exam_statuses.exam_id','=','conduct_exams.id')
                                      ->join('courses','courses.id','=','conduct_exams.course')
                                    //  ->join('exams_questions','exams_questions.course','=','conduct_exams.course')
                                      ->orderby('conduct_exams.id','desc')
                                      ->get();

                                      foreach ($data['conduct'] as $conduct) {
                                        $conduct->total_questions = ExamsQuestions::where('exams_questions.course', '=', $conduct->course)->count('exams_questions.question');
                                    }

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

          // Get the duration and unit from the request
        $duration = $request->input('time');
        $duration_unit = $request->input('duration_unit');

       // Convert the duration to minutes
        if ($duration_unit === 'hours') {
          $duration_in_minutes = $duration * 60; // 1 hour = 60 minutes
        } else {
          $duration_in_minutes = $duration;
        }

      try {
        DB::beginTransaction();

        // Create a new ConductExam object
        $schedule = new ConductExam();
        $schedule->schedule_name = isset($input['schedule_name']) ? $input['schedule_name'] : "";
        $schedule->time = $duration_in_minutes;
        $schedule->course = isset($input['course']) ? $input['course'] : "";
        $schedule->exam_name = isset($input['exam_name']) ? $input['exam_name'] : "";
        $schedule->service = isset($input['service']) ? $input['service'] : "";
        $schedule->category = isset($input['category']) ? $input['category'] : "";
        $schedule->trainer_qa = isset($input['trainer_qa']) ? $input['trainer_qa'] : "";
        $schedule->start_date = isset($input['start_date']) ? $input['start_date'] : "";
        $schedule->completion_date = isset($input['completion_date']) ? $input['completion_date'] : "";
        $schedule->created_by = isset($input['created_by']) ? $input['created_by'] : "";



        $schedule->save();

        log::channel('schedule')->info('schedule exam Created : ------> ', ['200', $schedule->toArray()]);

        // Generate unique schedule code
        // Prefix for the ID
          $prefix = 'Exam';

            // Retrieve the last assigned numeric value from the database
            $lastNumericValue = DB::table('counters')->select('value')->first();

              // If no value is found, start from 1, otherwise increment the last value
              $numericValue = $lastNumericValue ? intval($lastNumericValue->value) + 1 : 1;

              // Format the numeric value with leading zeros (8 digits)
              $formattedNumericValue = str_pad($numericValue, 8, '0', STR_PAD_LEFT);

              // Combine the prefix and formatted numeric value
              $uniqueID = $prefix . '-' . $formattedNumericValue;

             // Save the new numeric value back to the database
         if ($lastNumericValue) {
                     DB::table('counters')->update(['value' => $numericValue]);
                 } else {
                    DB::table('counters')->insert(['value' => $numericValue]);
                   }

         $schedule_id =  $uniqueID;



         $schedule->schedule_name = $schedule_id;
         $schedule->save();

        // Create a new ExamStatus object
        $examstatus = new ExamStatus();
        $examstatus->schedule_id = $schedule_id;
        $examstatus->exam_id = $schedule->id;
        $examstatus->created_by = $schedule->created_by;
        $examstatus->status = '1';
        $examstatus->start_time = Carbon::now();
        $examstatus->end_time = Carbon::now()->addMinutes($schedule->time);

        log::channel('examstatus')->info('exam status Created : ------> ', ['200', $examstatus->toArray()]);

        $examstatus->save();

        DB::commit();

        toast('Exam Scheduled successfully', 'success')->position('top-end');
        return redirect('exams/conduct_exam');
      } catch (\Throwable $e) {
        DB::rollBack();
        Log::info($e->getMessage());
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
    $viewquestion = ConductExam::find($id)
        ->join('exam_statuses', 'exam_statuses.exam_id', '=', 'conduct_exams.id')
        ->join('courses', 'courses.id', '=', 'conduct_exams.course')
        ->join('services', 'services.id', '=', 'conduct_exams.service')
        ->join('statuses', 'statuses.status_id', '=', 'status')
        ->join('categories', 'categories.id', '=', 'conduct_exams.category')
        ->join('users', 'users.id', '=', 'conduct_exams.trainer_qa')
        ->join('exams_questions', 'exams_questions.course', '=', 'conduct_exams.course')
        ->select('conduct_exams.id', 'conduct_exams.category', 'conduct_exams.time', 'conduct_exams.course', 'conduct_exams.exam_name', 'conduct_exams.service', 'conduct_exams.category', 'conduct_exams.trainer_qa', 'conduct_exams.start_date', 'conduct_exams.completion_date', 'conduct_exams.created_at', 'exams_questions.question', 'exams_questions.id as q_id', 'courses.course_name', 'services.service_name', 'categories.category_name', 'users.name', 'exam_statuses.schedule_id', 'exam_statuses.status', 'statuses.status_name')
        ->where('conduct_exams.id', '=', $id)
        ->get();

    foreach ($viewquestion as $key => $value) {
        $questions = ExamsQuestions::select('exams_questions.id', 'exams_questions.question', 'exams_questions.course')
            ->where('exams_questions.course', '=', $value->course)
            ->get();

        foreach ($questions as $k => $question) {
            $choices = AnswerKeys::select('id', 'choices', 'question_weight')
                ->where('question_id', '=', $question->id)
                ->get();

            $question->choices = $choices; // Assign choices to the question object
        }

        $value->question = $questions; // Assign questions to the value object
    }

    $data['viewquestion'] = $viewquestion;
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

        $trainerRole_id = Role::select('roles.id',)->where('name', '=', 'trainer')->orWhere('name', '=','quality-analyst')->first();



        $trainer= User::select('users.name','users.id','model_has_roles.role_id')
                          ->join('model_has_roles','model_id','=','users.id')
                           ->join('roles','roles.id','=','model_has_roles.role_id')
                          ->where('model_has_roles.role_id','=',$trainerRole_id)
                          ->get();
                

        $service = Services::all()->toArray();
        $category = Categories::all()->toArray();


        $data['conduct'] = ConductExam::select('conduct_exams.id','conduct_exams.category','conduct_exams.time','conduct_exams.course','conduct_exams.exam_name','conduct_exams.service',
        'conduct_exams.category','conduct_exams.trainer_qa','conduct_exams.start_date','conduct_exams.completion_date','conduct_exams.created_at','exam_statuses.schedule_id','courses.course_name',
        'users.name as trainerName','categories.category_name','user_categories.category_id')
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

    public function reactivate($id)
    {

        // Get the currently authenticated user's ID
        $userId = Auth::user()->id;
        // Find the row in the exam_statuses table with the given ID
        $row = DB::table('exam_statuses')->where('id', $id)->first();

        // Generate a new unique ID for the reactivated exam
        $prefix = 'Exam';
        $lastNumericValue = DB::table('counters')->select('value')->first();
        $numericValue = $lastNumericValue ? intval($lastNumericValue->value) + 1 : 1;
        $formattedNumericValue = str_pad($numericValue, 8, '0', STR_PAD_LEFT);
        $uniqueID = $prefix . '-' . $formattedNumericValue;

        DB::table('exam_statuses')->insert([
            'schedule_id' => $uniqueID,
            'status' => 1,
            'created_by' => $userId,
        ]);


        // Save the new numeric value back to the database
        if ($lastNumericValue) {
            DB::table('counters')->update(['value' => $numericValue]);
        } else {
            DB::table('counters')->insert(['value' => $numericValue]);
        }

        $reactivatedID =  $uniqueID;

        // Get the currently authenticated user's ID
        $userId = Auth::user()->id;

        $reactivatedExam = ConductExam::find($id);

        $NewExam = new ConductExam();
        $NewExam->schedule_name = $reactivatedID;
        $NewExam->course = $reactivatedExam->course;
        $NewExam->time = $reactivatedExam->time;
        $NewExam->exam_name = $reactivatedExam->exam_name;
        $NewExam->service = $reactivatedExam->service;
        $NewExam->category = $reactivatedExam->category;
        $NewExam->trainer_qa = $reactivatedExam->trainer_qa;
        $NewExam->start_date = $reactivatedExam->start_date;
        $NewExam->completion_date = $reactivatedExam->completion_date;
        $NewExam->created_by = $userId;

        log::channel('reactivateexam')->info('exam reactivated : ------> ', ['200', $NewExam->toArray()]);

        $NewExam->save();

        $NewExamStatus = new ExamStatus();
        $NewExamStatus->schedule_id = $reactivatedID;
        $NewExamStatus->exam_id = $NewExam->id;
        $NewExamStatus->created_by = $userId;
        $NewExamStatus->status = '1';
        $NewExamStatus->start_time = Carbon::now();
        $NewExamStatus->end_time = Carbon::now()->addMinutes($NewExamStatus->start_time );

        log::channel('newexamstatus')->info('exam reactivated newexamstatus : ------> ', ['200', $NewExamStatus->toArray()]);

        $NewExamStatus->save();

          // Show the Sweet Alert toast
        toast('Exam reactivated with new ID: ' . $uniqueID, 'success')->position('top-end');

        // Redirect back
        return redirect()->back();

    }


    public function activate($id)
    {
        /** @var ExamStatus $ExamStatus */
        $examstatus = ExamStatus::findOrFail($id);

        $examstatus->status = 1;

        $examstatus->save();

        return back();
    }


    public function deactivate($id)
    {

        $examstatus = ExamStatus::where('exam_id','=', $id)->first();
        $examstatus->status = 0;
        $examstatus->save();
        toast('Exam Deactivated', 'success')->position('top-end');
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

        // Get the duration and unit from the request
        $duration = $request->input('time');
        $duration_unit = $request->input('duration_unit');

        // Convert the duration to minutes
        if ($duration_unit === 'hours') {
            $duration_in_minutes = $duration * 60; // 1 hour = 60 minutes
        } else {
            $duration_in_minutes = $duration;
        }

        try {
            DB::beginTransaction();

            $updating = ConductExam::findOrFail($id);
            $updating->time = $duration_in_minutes;
            $updating->course = isset($input['course']) ? intval($input['course']) : null;
            $updating->exam_name = $input['exam_name'] ?? null;
            $updating->service = isset($input['service']) ? intval($input['service']) : null;
            $updating->category = isset($input['category']) ? intval($input['category']) : null;
            $updating->trainer_qa = isset($input['trainer_qa']) ? intval($input['trainer_qa']) : null;
            $updating->start_date = $input['start_date'] ?? null;
            $updating->completion_date = $input['completion_date'] ?? null;
            $updating->created_by = isset($input['created_by']) ? intval($input['created_by']) : null;

            // Debugging to ensure the correct data is being updated
            Log::info('Updating ConductExam', $updating->toArray());

            $updating->save();

            Log::channel('update conduct')->info('ConductExam updated successfully', ['200', $updating->toArray()]);

            DB::commit();
            toast('Parameter edited successfully', 'success')->position('top-end');

            return redirect()->route('conductexam.show', ['conductexam' => $id]);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error updating ConductExam: ' . $e->getMessage());
            toast('Something Went Wrong', 'warning')->position('top-end');
            throw $e;
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
        // Retrieve the record with the given ID
        $conductExam = ConductExam::find($id);

        // Check if the record exists
        if ($conductExam) {
            // Delete the record
            $conductExam->delete();

            // Optionally, you can redirect the user to a specific route or page
            return redirect()->route('exams/conduct_exam')->with('success', 'Record deleted successfully.');
        } else {
            // Handle the case where the record does not exist
            return redirect()->route('exams/conduct_exam')->with('error', 'Record not found.');
        }
    }

}
