<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\exam_results;
use Datatables;
use App\Models\User;
use App\Models\Courses;
use App\Models\Services;
use App\Models\AnswerKeys;
use App\Models\ExamsQuestions;
use App\Models\ConductExam;

class ExamsResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $examresults = exam_results::select('exam_results.id','exam_results.question_id','exam_results.answers_selected','exam_results.marks_achieved','exam_results.created_by','exam_results.created_at',
                                            'exam_results.conduct_id','exams_questions.question','answer_keys.choices','exams_questions.id','user_categories.category_id','user_categories.user_id',
                                            'conduct_exams.course','conduct_exams.exam_name','conduct_exams.completion_date','conduct_exams.service','conduct_exams.trainer_qa','users.name',
                                             'courses.course_name','services.service_name','services.id as s_id','categories.category_name',
                                            )
                                            ->join('conduct_exams','conduct_exams.id','=','exam_results.conduct_id')
                                            ->join('exams_questions','exams_questions.id','=','exam_results.question_id')
                                            ->join('answer_keys','answer_keys.question_id','=','exams_questions.id')
                                            ->join('user_categories','user_categories.user_id','=','exam_results.created_by')
                                            ->join('users','users.id','=','user_categories.user_id')
                                            ->join('model_has_roles','model_id','=','exam_results.created_by')
                                            ->join('courses','courses.id','=','conduct_exams.course')
                                            ->join('categories','categories.id','=','user_categories.category_id')
                                            ->join('services','services.id','=','conduct_exams.service')
                                             //->where('exam_results.id','=',$id)
                                           ->get();

                                            //print_pre($examresults, true);

                                           $data['examresults']=$examresults;

                                        //    dd($data);
        return view('exams/exam_result')->with($data);
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
        $exam_results = exam_results::select('exam_results.id','exam_results.question_id','exam_results.answers_selected','exam_results.marks_achieved','exam_results.created_by','exam_results.created_at',
                                            'exam_results.conduct_id','exams_questions.question','answer_keys.choices',

        )
        ->join('conduct_exams','conduct_exams.id','=','exam_results.conduct_id')
        ->join('exams_questions','exams_questions.id','=','exam_results.question_id')
        ->join('answer_keys','answer_keys.question_id','=','exams_questions.id')
        ->where('exam_results.conduct_id','=',$id)
       ->get();



       foreach ($exam_results as $key => $value) {

        $questions = $value['question_id'];

           $questionDone = ExamsQuestions::where('id','=',$questions)->first();
           $value['questionDone'] =  isset($questionDone)  ?  $questionDone->question : '';


       }

    //    foreach($exam_results as $ke => $ansDone){

    //     $answer = $ansDone['answers_selected'];

    //     $question_id = exam_results::select('exam_results.question_id')->where('exam_results.conduct_id','=',$id)->first();

    //     $answerDone = AnswerKeys::where('id','=',$answer) ->orwhere('question_id','=',$question_id)->get();
    //     $value['answerDone'] =  isset($answerDone)  ?  $answerDone->choices : '';

    //    // dd([$answerDone]);

    //  // print_pre([$answerDone], true);

    // }
    foreach ($exam_results as $ke => $ansDone) {
        $answers_selected = $ansDone['answers_selected'];
        $question_id = exam_results::select('exam_results.question_id')->where('exam_results.conduct_id', '=', $id)->first();
        $values = [];

        if (is_array($answers_selected)) {
            $answerDone = AnswerKeys::whereIn('id', $answers_selected)->orWhere('question_id', $question_id)->first();

            foreach ($answerDone as $answer) {
                $values[] = isset($answer) ? $answer->choices : '';
            }
        }

        $ansDone['answerDone'] = $values;

        //print_pre([$ansDone], true);
    }




       $data['exam_results']=$exam_results;

      // print_pre($questionDone, true);


        return view('exams/view_exam_results')->with($data);
    }

    public function viewResults($conduct_id, $created_by)
{

    $exam_results = exam_results::select('exam_results.question_id','exam_results.answers_selected','exam_results.marks_achieved','exam_results.conduct_id','exam_results.created_by',
                                          'answer_keys.question_id','answer_keys.choices','answer_keys.question_weight','answer_keys.created_by','answer_keys.is_correct','exams_questions.question')
                                          ->where('exam_results.conduct_id','=',$conduct_id)
                                          ->where('exam_results.created_by','=',$created_by)
                                          ->where('answer_keys.is_correct','=',1)
                                  ->join('answer_keys','answer_keys.question_id','=','exam_results.question_id')
                                  ->join('exams_questions','exams_questions.id','=','exam_results.question_id')
                                  ->get();



    $totalQuestions = $exam_results->count();
    $correctAnswers = $exam_results->filter(function ($result) {
        return $result->marks_achieved > 0;
    })->count();

    $wrongAnswers = $totalQuestions - $correctAnswers;

    $totalMarks = $exam_results->sum('marks_achieved');



    return view('exams.view_results', compact('exam_results', 'totalQuestions', 'correctAnswers', 'wrongAnswers', 'totalMarks'));
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
