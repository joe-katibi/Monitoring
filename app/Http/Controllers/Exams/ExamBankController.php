<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Answers;
use App\Models\AnswerKeys;
use App\Models\Services;
use App\Models\ExamsQuestions;
use Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ExamBankController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $examquestion = Courses::select('courses.id','courses.course_name','courses.service_id','courses.created_at','services.service_name')
                           ->join('services','services.id','=','courses.service_id')
                           ->get();

        return view('exams/exam_bank',compact('examquestion'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
       $Course = Courses ::all()->toArray();
     //  $answer = Answers ::all()->toArray();
       $service = Services ::all()->toArray();

       return view('exams/create_exam',compact('Course','service'));
    }

    public function store(Request $request)
{
    $input = $request->all();


    try {
        DB::beginTransaction();

        $examination = new ExamsQuestions();
        $examination->service = isset($input['service']) ? $input['service'] : "";
        $examination->course = isset($input['course']) ? $input['course'] : "";
        $examination->created_by = isset($input['created_by']) ? $input['created_by'] : "";
        $examination->question = isset($input['question']) ? $input['question'] : "";



        $examination->save();

        log::channel('examination')->info('examination Created : ------> ', ['200', $examination->toArray()]);

        // Loop through each question and store the corresponding question results.
        $choices = ['answer_a', 'answer_b', 'answer_c', 'answer_d'];
        $isCorrectIndex = array_search($input['is_correct'], $choices);


        // print_pre([$isCorrectIndex], true);
        foreach ($input['question_weight_'] as $key => $value) {
            // Create a new AnswerKeys object
            $answers = new AnswerKeys();

            $answers->question_id = $examination->id;
            $answers->key_choice = $key;
            $answers->question_weight = $value;
            $answers->choices = isset($input[$choices[$key]]) ? $input[$choices[$key]] : "";
            $answers->is_correct = ($isCorrectIndex === $key) ? 1 : 0;
            $answers->created_by = $examination->created_by;

           // print_pre([$choices], true);

            $answers->save();
        }

        DB::commit();

        toast('Question Created successfully', 'success')->position('top-end');
        return redirect('exams/exam_bank');
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
     *
     */

    public function questionShow($id)
    {

        $course = Courses::find($id);

        if (!$course) {
            // Course not found, you can handle this case accordingly.
            return redirect()->back()->with('error', 'Course not found.');
        }

        $questions = ExamsQuestions::select('exams_questions.id','exams_questions.question', 'exams_questions.course',
                                          'exams_questions.service', 'exams_questions.created_at','courses.course_name')
                                       ->join('courses','courses.id','=','exams_questions.course')
                                       ->where('exams_questions.course','=',$id)
                                       ->get();

                   if ($questions->isEmpty()) {
                  // No questions found, display the error/alert message
                  $message = "No question/s found. Please create questions for the course called {$course->course_name}.";
                   toast( $message , 'warning')->position('center');

                  return redirect()->back()->with('message', $message);
                  }

         return view('exams/view_questions',compact('questions',));


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = ExamsQuestions::select('exams_questions.id','exams_questions.question','answer_keys.choices')
                                     ->join('answer_keys','answer_keys.question_id','=','exams_questions.id')
                                    ->where('exams_questions.id','=',$id)
                                     ->get();

        foreach ($questions as $key => $value) {

                $value['choices'] = AnswerKeys::select('id', 'choices', 'question_weight')
                                               ->where('question_id', '=', $value->id)
                                                ->get();
                                                }

        return view('exams/exam_view',compact('questions',));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $questions = ExamsQuestions::select('exams_questions.id','exams_questions.question','answer_keys.choices')
                                     ->join('answer_keys','answer_keys.question_id','=','exams_questions.id')
                                    ->where('exams_questions.id','=',$id)
                                     ->get();

        foreach ($questions as $key => $value) {

                $value['choices'] = AnswerKeys::select('id', 'choices', 'question_weight')
                                               ->where('question_id', '=', $value->id)
                                                ->get();
                                                }


        return view('exams/edit_exam',compact('questions'));
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
        // $input = $request->all();
        $questions = $request->input('questions');

         $firstQuestion = $questions[0];
         $examQuestion = ExamsQuestions::findOrFail($firstQuestion['id']);
         $examQuestion->question = $firstQuestion['question'];
         $examQuestion->created_by = Auth::user()->id;

         $examQuestion->update();

         $choicesData = $firstQuestion['choices'];
         foreach ($choicesData as $choiceId => $choiceArray) {
            foreach($choiceArray as $key =>$values){

                $choice = $values["choice"];
                $questionWeight = $values["question_weight"];
                $examChoice = AnswerKeys::find($choiceId);

                if ($examChoice) {
                $examChoice->choices = $choice;
                $examChoice->question_weight = $questionWeight;
                $examChoice->update();
               }

            }
         }
         toast('Question Edited successfully', 'success')->position('top-end');
           return redirect()->back();

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamsQuestions $questions)
    {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $questions->delete();
        }
        return to_route('exam_bank');
    }
}
