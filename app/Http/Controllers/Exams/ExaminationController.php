<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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


        $conduct = ConductExam::select('conduct_exams.id','conduct_exams.schedule_name','conduct_exams.time','conduct_exams.course',
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
                                          ->get();
        $reporttype = ReportType::select('report_types.type_id','report_types.type_name')->where('id', '=', 2)->first();

        // dd($reporttype);

        $courseID = ConductExam::select('id' , 'course', 'time')->where('id', '=' , $id )->first();

        $questions = ExamsQuestions::select('exams_questions.id', 'exams_questions.course','exams_questions.question')
                                    ->where('exams_questions.course', '=', $courseID->course)
                                    ->get();

        foreach ($questions as $key => $value) {

            $value['choices'] = AnswerKeys::select('id', 'choices', 'question_weight')
                                ->where('question_id', '=', $value->id)
                                ->get();
            }

            $examID = ExamStatus::select('id')->where('exam_id', '=' , $id )->first();

           // Create a new exam and set the start time and end time
           //$exam = ExamStatus::find($examID);
           $start_time = now();
           $end_time = now()->addMinutes(30);
          // $exam->created_by=  Auth::user()->name;
             //dd($exam);

          //$exam->save();


           // Dispatch the ExamStatusJob to check the status of the exam
           //ExamStatusJob::dispatch($exam)->delay($end_time );

           // Calculate the time remaining for the exam
           $diff = now()->diff($end_time);
           $minutes = $diff->i;
           $seconds = $diff->s;
           $timeRemaining = "$minutes minutes, $seconds seconds";


           // Return a response with the exam details
          toast('Exam started successfully','success');

                                            $data['conduct'] = $conduct;
                                            $data['questions'] = $questions;
                                            //$data['exam'] = $exam;
                                            $data['start_time'] = $start_time;
                                            $data['end_time'] = $end_time->format('Y-m-d H:i:s');
                                            $data['timeRemaining'] = $timeRemaining;
                                            $data['reporttype'] = $reporttype;

                                        //    print_pre($data , true);

                                        // dd($exam);
        return view('exams/examination', )->with($data);
    }

    public function index1($id)
    {
            // $course=Courses::where('id','=','courses.id');

            $data = ExamsQuestions::select('exams_questions.id','exams_questions.question','exams_questions.answer_a','exams_questions.answer_b',
                                        'exams_questions.answer_c','exams_questions.answer_d','exams_questions.question_weight','exams_questions.course','exams_questions.answer_key','exams_questions.service','conduct_exams.schedule_name','conduct_exams.time','conduct_exams.course','conduct_exams.exam_name','conduct_exams.service','conduct_exams.category','conduct_exams.trainer_qa','conduct_exams.start_date','conduct_exams.completion_date','courses.course_name','conduct_exams.id','exam_statuses.schedule_id','exam_statuses.status','exam_statuses.exam_id','users.name','users.category','answers.answer_name','courses.id')
                        ->join('conduct_exams','conduct_exams.course','=','exams_questions.course')
                        ->join('services','services.id','=','exams_questions.service')
                        ->join('courses','courses.id','=','exams_questions.course')
                        ->join('users','users.id','=','conduct_exams.trainer_qa')
                        ->join('exam_statuses','exam_statuses.exam_id','=','conduct_exams.id')
                        ->join('answers','answers.id','=','exams_questions.answer_key')
                        ->where('courses.id','=', $id)
                        ->get();

                        print_pre($data , true);

            return view('exams/examination')->with(['examination' => $data[0], 'examdetails' => $data[0], 'exam' => $data]);

    }


    // public function startExam(Request $request)
    // {
    //     // Create a new exam and set the start time and end time
    //     $exam = new ExaminationController();
    //     $exam->start_time = now();
    //     $exam->end_time = now()->addMinutes(30);
    //     $exam->status = 'active';
    //     $exam->save();

    //     // Dispatch the ExamStatusJob to check the status of the exam
    //     ExamStatusJob::dispatch($exam)->delay($exam->end_time);

    //     // Return a response with the exam details
    //     return response()->json([
    //         'message' => 'Exam started successfully',
    //         'exam' => $exam
    //     ]);


    //     dd($exam );
    // }


    public function deactivate()
    {
        //Deactivate the exam here

        return redirect()->route('exams/agent_examination')->with('status','Exam Has been Deactivated');


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
    // public function store(Request $request)
    // {
    //     $input =$request->all();
    //     $string = implode(', ', $input['question-answer-']);
    //     $schedule = implode(', ', $input['schedule']);

    //     dd($input);

    //      try {



    //         foreach($input['question-answer-'] as $key => $value){

    //              $examresults = new exam_results();
    //              $answer_key = AnswerKeys::whereIn('id', $input['question-answer-'] )->where('question_weight','>',0)
    //                                       ->select('question_weight')
    //                                      //->sum('question_weight')
    //                                        ->get();

    //             //$examresults->answers_selected = $string;
    //             foreach($string as $key =>$values){


    //             }

    //              dd($values);


    //             $examresults->question_id =  $schedule ;
    //             $examresults->marks_achieved =  $answer_key;
    //             $examresults->conduct_id =  isset($input['conduct_id']) ? $input['conduct_id']:"";
    //             $examresults->Created_by =  isset($input['created_by']) ? $input['created_by']:"";
    //             $examresults->report_type_id = isset($input['reporttype']) ? $input['reporttype'] :"";


    //             // dd($examresults);

    //             $examresults->save();

    //             DB::commit();
    //             toast('Exam Completed successfully','success')->position('top-end');
    //             return view('exams/view_exam_results'.$examresults->id);



    //          }


    //      } catch (\Throwable $e) {


    //         DB::rollBack();
    //         Log::info($e->getMessage() );
    //         throw $e;

    //      }


    // }


public function store(Request $request)
{
    $input = $request->all();

 //   dd($input);

   // print_pre([$input], true);



    try {
        foreach ($input['question-answer-'] as $question_id => $answer_id) {

            $answer_key = AnswerKeys::where('id', $answer_id )->select('question_weight')->first();

            //dd($answer_key);

            //print_pre([$answer_key], true);



            $exam_results = new exam_results();

            $exam_results->question_id = $question_id;
            $exam_results->answers_selected = $answer_id;
            $exam_results->marks_achieved =  $answer_key->question_weight;
            $exam_results->conduct_id = isset($input['conduct_id']) ? $input['conduct_id'] : null;
            $exam_results->created_by = isset($input['created_by']) ? $input['created_by'] : null;
            $exam_results->report_type_id = isset($input['reporttype']) ? $input['reporttype'] : null;

           // print_pre([$exam_results], true);

            $exam_results->save();
        }

        DB::commit();

        toast('Exam completed successfully', 'success')->position('top-end');

        return redirect('exams/view_results/'.$exam_results->conduct_id.'/'.$exam_results->created_by);

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
                                      ->get();

        return view('exams/agent_examination')->with($data);
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
