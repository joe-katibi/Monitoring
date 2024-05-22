<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Models\ConductExam;
use App\Models\Categories;
use App\Models\ExamsQuestions;
use App\Models\exam_results;
use App\Models\User;
use App\Models\Courses;
use App\Models\Services;
use App\Models\ExamStatus;
use App\Models\Answers;
use App\Models\AnswerKeys;
use App\Models\ReportType;
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Jobs\ExamStatusJob;



class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $conduct = ConductExam::select('conduct_exams.id','conduct_exams.schedule_name','conduct_exams.time as duration','conduct_exams.course',
                                         'conduct_exams.exam_name','conduct_exams.service','conduct_exams.category','conduct_exams.trainer_qa',
                                         'conduct_exams.start_date','conduct_exams.completion_date','conduct_exams.created_at','users.name',
                                         'exams_questions.question','categories.category_name','services.service_name','exam_statuses.schedule_id','exams_questions.id as q_id',
                                         'answer_keys.choices','answer_keys.question_id','answer_keys.question_weight','answer_keys.id as a_id',
                                         'exam_statuses.id as s_id',
                                         )
                                         ->join('users','users.id','=','conduct_exams.trainer_qa')
                                         ->join('exams_questions','exams_questions.course','=','conduct_exams.course')
                                         ->Join('answer_keys','answer_keys.question_id','=','exams_questions.id')
                                         ->join('categories','categories.id','=','conduct_exams.category')
                                         ->join('services','services.id','=','conduct_exams.service')
                                         ->join('exam_statuses','exam_statuses.exam_id','=','conduct_exams.id')

                                         ->where('conduct_exams.id','=',$id)
                                          ->first();

         $total_questions = ExamsQuestions::where('exams_questions.course', '=', $conduct->course)->count('exams_questions.question');


        $reporttype = ReportType::select('report_types.type_id','report_types.type_name')->where('id', '=', 2)->first();

        $courseID = ConductExam::select('id' , 'course', 'time')->where('id', '=' , $id )->first();

        $questions = ExamsQuestions::select('exams_questions.id', 'exams_questions.course','exams_questions.question')
                                    ->where('exams_questions.course', '=', $courseID->course)
                                    ->get();

        foreach ($questions as $key => $value) {

            $value['choices'] = AnswerKeys::select('id', 'choices', 'question_weight')
                                ->where('question_id', '=', $value->id)
                                ->get();
            }

            $examID = ExamStatus::select('schedule_id')->where('exam_id', '=' , $id )->first();

           $start_time = now();
           $end_time = now()->addMinutes($conduct->duration);

           // Calculate the time remaining for the exam
           $diff = now()->diff($end_time);
           $minutes = $diff->i;
           $seconds = $diff->s;
           $timeRemaining = "$minutes minutes, $seconds seconds";



           // Return a response with the exam details
          toast('Exam started successfully','success');

                                            $data['conduct'] = $conduct;
                                            $data['questions'] = $questions;
                                            $data['examID'] = $examID;
                                            $data['start_time'] = $start_time;
                                            $data['end_time'] = $end_time->format('Y-m-d H:i:s');
                                            $data['timeRemaining'] = $timeRemaining;
                                            $data['reporttype'] = $reporttype;
                                            $data['total_questions'] = $total_questions;

                                            //dd($data);

        return view('exams/examination', )->with($data);
    }

    public function deactivate()
    {
        //Deactivate the exam here
        return redirect()->route('exams/agent_examination')->with('status','Exam Has been Deactivated');

    }

    public function store(Request $request)
    {
      $input = $request->all();

      try {
          foreach ($input['question-answer-'] as $question_id => $answer_id) {

            $answer_key = AnswerKeys::where('id', $answer_id )->select('question_weight')->first();

            $exam_results = new exam_results();

            $exam_results->question_id = $question_id;
            $exam_results->answers_selected = $answer_id;
            $exam_results->marks_achieved =  $answer_key->question_weight;
            $exam_results->conduct_id = isset($input['conduct_id']) ? $input['conduct_id'] : null;
            $exam_results->created_by = isset($input['created_by']) ? $input['created_by'] : null;
            $exam_results->report_type_id = isset($input['reporttype']) ? $input['reporttype'] : null;
            $exam_results->schedule_id = isset($input['examId']) ? $input['examId'] : null;

            $exam_results->save();
          }

        DB::commit();
        toast('Exam completed successfully', 'success')->position('top-end');
        return redirect('exams/view_results/'.$exam_results->conduct_id.'/'.$exam_results->created_by.'/'.$exam_results->schedule_id);

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
    public function show()
    {

        $data['conduct'] = ConductExam::select('conduct_exams.id','conduct_exams.schedule_name','conduct_exams.time','conduct_exams.course',
                                      'conduct_exams.exam_name','conduct_exams.service','conduct_exams.category','conduct_exams.trainer_qa',
                                      'conduct_exams.start_date','conduct_exams.completion_date','conduct_exams.created_at','exam_statuses.schedule_id',
                                      'courses.course_name','users.name','categories.category_name','exam_statuses.status')
                                      ->join('users','users.id','=','conduct_exams.trainer_qa')
                                      ->join('categories','categories.id','=','conduct_exams.category')
                                      ->join('services','services.id','=','conduct_exams.service')
                                      ->join('exam_statuses','exam_statuses.exam_id','=','conduct_exams.id')
                                      ->join('courses','courses.id','=','conduct_exams.course')
                                      ->orderby('conduct_exams.id','desc')
                                      ->get();

             foreach ($data['conduct'] as $conduct) {
                                        $conduct->total_questions = ExamsQuestions::where('exams_questions.course', '=', $conduct->course)->count('exams_questions.question');
                                    }

        // Get the currently authenticated user's ID
        $userId = Auth::user()->id;

        // Get the IDs of the exams being shown in the table
        $examIds = $data['conduct']->pluck('id')->toArray();

        // Get all exam_results for the exams shown in the table
        $examResults = exam_results::where('created_by', $userId)
            ->whereIn('conduct_id', $examIds)
            ->orWhereIn('schedule_id', $examIds)
            ->get();

        // Process the results to create a map of exam IDs to exam attempts
        $examAttempts = [];
        foreach ($examResults as $result) {
            $examAttempts[$result->conduct_id] = true;
            $examAttempts[$result->schedule_id] = true;
            $examAttempts[$result->created_by] = true;
            $examAttempts[$result->conduct_id] = true;
        }

        // Add the exam attempts data to the $data array
        $data['examAttempts'] = $examAttempts;
        $data['userId'] = $userId;

        return view('exams/agent_examination')->with($data);
    }

}
