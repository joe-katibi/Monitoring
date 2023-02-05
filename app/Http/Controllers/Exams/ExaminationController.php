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
use App\Models\User;
use App\Models\Courses;
use App\Models\Services;
use App\Models\ExamStatus;
use App\Models\Answers;
use Datatables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;


class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $course=Courses::where('id','=','courses.id');


        $examination =ExamsQuestions::select('exams_questions.id','exams_questions.question','exams_questions.answer_a','exams_questions.answer_b',
                                            'exams_questions.answer_c','exams_questions.answer_d','exams_questions.question_weight','exams_questions.course','exams_questions.answer_key','exams_questions.service','conduct_exams.schedule_name','conduct_exams.time','conduct_exams.course','conduct_exams.exam_name','conduct_exams.service','conduct_exams.category','conduct_exams.trainer_qa','conduct_exams.start_date','conduct_exams.completion_date','courses.course_name','conduct_exams.id','exam_statuses.schedule_id','exam_statuses.status','exam_statuses.exam_id','users.name','users.category','answers.answer_name','courses.id')
                                            ->join('conduct_exams','conduct_exams.course','=','exams_questions.course')
                                            ->join('services','services.id','=','exams_questions.service')
                                            // ->join('categories','categories.id','=','conduct_exams.category')
                                            ->join('courses','courses.id','=','exams_questions.course')
                                            ->join('users','users.id','=','conduct_exams.trainer_qa')
                                            ->join('exam_statuses','exam_statuses.exam_id','=','conduct_exams.id')
                                            ->join('answers','answers.id','=','exams_questions.answer_key')
                                            // ->where('exams_questions.course','=','courses.id')
                                            ->where('courses.id','=',6)
                                            ->first()
                                            ;
        $examdetails = ExamsQuestions::select('exams_questions.id','exams_questions.question','exams_questions.answer_a','exams_questions.answer_b',
                                              'exams_questions.answer_c','exams_questions.answer_d','exams_questions.question_weight','exams_questions.course','exams_questions.answer_key','exams_questions.service','conduct_exams.schedule_name','conduct_exams.time','conduct_exams.course','conduct_exams.exam_name','conduct_exams.service','conduct_exams.category','conduct_exams.trainer_qa','conduct_exams.start_date','conduct_exams.completion_date','users.name','categories.category_name')
                                             ->join('conduct_exams','conduct_exams.course','=','exams_questions.course')
                                             ->where('exams_questions.course','=',6)
                                             ->join('users','users.id','=','conduct_exams.trainer_qa')
                                             ->join('categories','categories.id','=','conduct_exams.category')
                                             ->first();

         $exam = ExamsQuestions::select('exams_questions.id','exams_questions.question','exams_questions.answer_a','exams_questions.answer_b',
                                        'exams_questions.answer_c','exams_questions.answer_d','exams_questions.question_weight','exams_questions.course','exams_questions.answer_key','exams_questions.service','conduct_exams.schedule_name','conduct_exams.time','conduct_exams.course','conduct_exams.exam_name','conduct_exams.service','conduct_exams.category','conduct_exams.trainer_qa','conduct_exams.start_date','conduct_exams.completion_date',)
                                         ->join('conduct_exams','conduct_exams.course','=','exams_questions.course')
                                         ->where('exams_questions.course','=',6)
                                        ->get();


                                            $data['examination'] = $examination;
                                            $data['examdetails'] = $examdetails;
                                            $data['exam'] = $exam;

                                        //    dd($data);
        return view('exams/examination', )->with($data);
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
