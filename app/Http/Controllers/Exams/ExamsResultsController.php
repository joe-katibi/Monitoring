<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\exam_results;
use Illuminate\Support\Facades\Auth;
use Datatables;
use App\Models\User;
use App\Models\Courses;
use App\Models\Services;
use App\Models\AnswerKeys;
use App\Models\ExamsQuestions;
use App\Models\ConductExam;
use App\Mail\AuditNotification;
use App\Models\Role;

class ExamsResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieves from the services table and returns them as a collection
        $services = Services::select('services.id','services.service_name')->get();

        $userId = auth()->id();

        $userLogged = User::select('users.name','users.id',)->where('users.id','=',$userId)->first();

        $agentRole_id = Role::select('roles.id',)->where('name', '=', 'Agent')->first();

        $agents = User::select('users.name','users.id','model_has_roles.role_id')
                        ->join('model_has_roles','model_id','=','users.id')
                       ->where('model_has_roles.role_id','=',$agentRole_id->id)
                        ->get();

        $examresults = [];

                                           $data['examresults']=$examresults;
                                           $data['services']=$services;
                                           $data['agents']=$agents;
                                           $data['userLogged']=$userLogged;

        return view('exams/exam_result')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $services = Services::select('services.id','services.service_name')->get();

        $userId = auth()->id();

        $userLogged = User::select('users.name','users.id',)->where('users.id','=',$userId)->first();

        $agentRole_id = Role::select('roles.id',)->where('name', '=', 'Agent')->first();

        $agents = User::select('users.name','users.id','model_has_roles.role_id')
                        ->join('model_has_roles','model_id','=','users.id')
                       ->where('model_has_roles.role_id','=',$agentRole_id->id)
                        ->get();

        $input = $request->all();

        $service = $request->input('service');

        $courses = $request->input('course');

        $examName = $request->input('exam_name');

        $agent = $request->input('agent');

        $departments = $request->input('department');

        $categoryname = $request->input('category');

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];

        $examresults = exam_results::select('exam_results.id','exam_results.question_id','exam_results.answers_selected','exam_results.marks_achieved','exam_results.created_by','exam_results.created_at',
                                            'exam_results.conduct_id','exams_questions.question','exam_results.schedule_id','answer_keys.choices',
                                            'exams_questions.id','user_categories.category_id','user_categories.user_id',
                                            'conduct_exams.course','conduct_exams.exam_name','conduct_exams.service','conduct_exams.trainer_qa',
                                            'users.name',
                                             'courses.course_name','services.service_name','services.id as s_id',
                                            'categories.category_name',
                                            )
                                            ->join('conduct_exams','conduct_exams.id','=','exam_results.conduct_id')
                                            ->join('exams_questions','exams_questions.id','=','exam_results.question_id')
                                             ->join('answer_keys','answer_keys.question_id','=','exams_questions.id')
                                             ->join('user_categories','user_categories.user_id','=','exam_results.created_by')
                                             ->join('users','users.id','=','user_categories.user_id')
                                           //  ->join('model_has_roles','model_id','=','exam_results.created_by')
                                             ->join('courses','courses.id','=','conduct_exams.course')
                                             ->join('categories','categories.id','=','user_categories.category_id')
                                             ->join('services','services.id','=','conduct_exams.service')
                                             ->where('conduct_exams.service','=',$service)
                                             ->where('conduct_exams.course','=',$courses)
                                             ->where('exam_results.created_by','=',$agent)
                                             ->where('user_categories.category_id','=',$departments)
                                            ->where('exam_results.created_at','>=',$start_date)
                                             ->where('exam_results.created_at','<=',$end_date)

                                           ->get();

        $data['services']=$services;
        $data['examresults']=$examresults;
        $data['agents']=$agents;
        $data['userLogged']=$userLogged;

        return view('exams/exam_result')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $schedule_id)
    {
        // Get the currently authenticated user's ID
        $userId = Auth::user()->id;

        $exam_results = exam_results::select(
            'exam_results.id',
            'exam_results.question_id',
            'exam_results.answers_selected',
            'exam_results.marks_achieved', // Get marks achieved
            'exam_results.created_by',
            'exam_results.created_at',
            'exam_results.conduct_id',
            'exams_questions.question',
            'answer_keys.choices',
            'exam_results.schedule_id'
        )
            ->join('conduct_exams', 'conduct_exams.id', '=', 'exam_results.conduct_id')
            ->join('exams_questions', 'exams_questions.id', '=', 'exam_results.question_id')
            ->join('answer_keys', 'answer_keys.question_id', '=', 'exams_questions.id')
            ->where('exam_results.conduct_id', '=', $id)
            ->where('exam_results.schedule_id', '=', $schedule_id)
            ->where('exam_results.created_by', '=', $userId)
            ->get();

        // Group the exam results by question_id
        $grouped_results = $exam_results->groupBy('question_id');

        // Transform the grouped results to an array
        $grouped_results_array = [];
        foreach ($grouped_results as $question_id => $results) {
            $questionDone = $results[0]->question; // Pick the question from the first result with the same question_id
            $answerDone = $results->pluck('choices')->toArray();
            $question_weight = $results[0]->marks_achieved; // Pick the marks_achieved from the first result with the same question_id
            $grouped_results_array[] = [
                'question_id' => $question_id,
                'questionDone' => $questionDone,
                'answerDone' => $answerDone,
                'question_weight' => $question_weight,
            ];
        }

        $data['exam_results'] = $grouped_results_array;


        return view('exams.view_exam_results', $data);
    }

    public function viewResults($conduct_id, $created_by, $schedule_id)
    {
        // Fetch exam results
        $exam_results = exam_results::select('exam_results.question_id','exam_results.answers_selected','exam_results.marks_achieved','exam_results.conduct_id','exam_results.created_by',
                                             'exam_results.schedule_id','exam_results.created_at',
                                             'answer_keys.question_id','answer_keys.choices','answer_keys.question_weight','answer_keys.created_by','answer_keys.is_correct','exams_questions.question','conduct_exams.exam_name','conduct_exams.course','users.name'
                                             )
                                      ->where('exam_results.conduct_id','=',$conduct_id)
                                      ->where('exam_results.created_by','=',$created_by)
                                      ->where('exam_results.schedule_id','=',$schedule_id)
                                      ->join('answer_keys','answer_keys.question_id','=','exam_results.question_id')
                                      ->join('exams_questions','exams_questions.id','=','exam_results.question_id')
                                      ->join('conduct_exams','conduct_exams.schedule_name','=','exam_results.schedule_id')
                                      ->join('users','users.id','=','exam_results.created_by')
                                      ->get();

        // Count correct answers
        $correctAnswers = exam_results::where('exam_results.conduct_id', '=', $conduct_id)
                                      ->where('exam_results.created_by', '=', $created_by)
                                      ->where('exam_results.schedule_id', '=', $schedule_id)
                                      ->where('exam_results.marks_achieved', '>', 0) // Filter where marks_achieved is greater than 0
                                      ->count();

   
        foreach ($exam_results as $exam_results) {
            $exam_results->total_questions = ExamsQuestions::where('exams_questions.course', '=', $exam_results->course)->count('exams_questions.question');

        }

        // Calculate total questions
        $totalQuestions = $exam_results->total_questions;

        // Count wrong answers
        $wrongAnswers = $totalQuestions - $correctAnswers;

        // Sum the total marks achieved
        $totalMarks = $exam_results->sum('marks_achieved');

          // Sum the question_weight and marks_achieved for the given exam
        $questionWeight = exam_results::selectRaw('SUM(answer_keys.question_weight) as total_question_weight')
                            ->where('exam_results.conduct_id','=',$conduct_id)
                            ->where('exam_results.created_by','=',$created_by)
                            ->where('exam_results.schedule_id','=',$schedule_id)
                            ->join('answer_keys','answer_keys.question_id','=','exam_results.question_id')
                            ->first();

        $marksAchieved = exam_results::selectRaw('SUM(exam_results.marks_achieved) as total_marks_achieved')
                            ->where('exam_results.conduct_id','=',$conduct_id)
                            ->where('exam_results.created_by','=',$created_by)
                            ->where('exam_results.schedule_id','=',$schedule_id)
                            ->first();

         // Calculate the percentage
        if ($questionWeight && $questionWeight->total_question_weight > 0) {
                 $percentage = ($marksAchieved->total_marks_achieved / $questionWeight->total_question_weight) * 100;
            } else {
              $percentage = 0; // Set percentage to 0 if there are no results or total_question_weight is 0
            }
                // Calculate average marks
                $averageMarks = $percentage;
                // Determine grade
                if ($averageMarks >= 90) {
                    $grade = 'Excellent';
                } elseif ($averageMarks >= 80 && $averageMarks < 90) {
                    $grade = 'Good';
                } elseif ($averageMarks >= 70 && $averageMarks < 80) {
                    $grade = 'Poor';
                } else {
                    $grade = 'Fail';
                }

        return view('exams.view_results', compact('exam_results', 'totalQuestions', 'correctAnswers', 'wrongAnswers', 'totalMarks', 'grade', 'percentage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $schedule_id)
    {
        $exam_results = exam_results::select(
            'exam_results.id',
            'exam_results.question_id',
            'exam_results.answers_selected',
            'exam_results.marks_achieved', // Get marks achieved
            'exam_results.created_by',
            'exam_results.created_at',
            'exam_results.conduct_id',
            'exams_questions.question',
            'answer_keys.choices',
            'exam_results.schedule_id','users.name','conduct_exams.exam_name'
        )
            ->join('conduct_exams', 'conduct_exams.id', '=', 'exam_results.conduct_id')
            ->join('exams_questions', 'exams_questions.id', '=', 'exam_results.question_id')
            ->join('answer_keys', 'answer_keys.question_id', '=', 'exams_questions.id')
            ->join('users','users.id','=','exam_results.created_by')
            ->where('exam_results.question_id', '=', $id)
            ->where('exam_results.schedule_id', '=', $schedule_id)
            // ->where('exam_results.created_by', '=', $userId)
            ->get();

            $totalQuestions = $exam_results->count();
            $correctAnswers = $exam_results->filter(function ($result) {
                return $result->marks_achieved > 0;
            })->count();

            $wrongAnswers = $totalQuestions - $correctAnswers;

            $totalMarks = $exam_results->sum('marks_achieved');

            $averageMarks = $totalMarks;

            $grade = '';

            if ($averageMarks >= 90) {
                $grade = 'Excellent';
            } elseif ($averageMarks >= 80 && $averageMarks < 90) {
                $grade = 'Good';
            } elseif ($averageMarks >= 70 && $averageMarks < 80) {
                $grade = 'Poor';
            } else {
                $grade = 'Fail';
            }

        return view('exams.exams_show', compact('exam_results', 'totalQuestions', 'correctAnswers', 'wrongAnswers', 'totalMarks','grade'));
    }

}
