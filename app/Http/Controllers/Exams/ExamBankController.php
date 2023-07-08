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
use Illuminate\Support\Facades\Log;

class ExamBankController extends Controller
{

      //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['role:super-admin|admin|moderator|developer|quality-analysts|trainer']);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examquestion = ExamsQuestions::select('exams_questions.id','exams_questions.question',
                                           'exams_questions.course','exams_questions.service', 'exams_questions.created_at','services.service_name','courses.course_name')
                                            //->join('answers','answers.id','=','exams_questions.answer_key')
                                            ->join('services','services.service_id','=','exams_questions.service')
                                            ->join('courses','courses.id','=','exams_questions.course')
                                            ->get();

                                            // dd($examquestion );
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
       $answer = Answers ::all()->toArray();
       $service = Services ::all()->toArray();

       return view('exams/create_exam',compact('Course','answer','service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $input = $request->all();

    //    print_pre( [$input], true);

    // //  dd($input);

    //     try{

    //         DB::beginTransaction();

    //         $examination = new ExamsQuestions();
    //         $examination->service = isset($input['service']) ? $input['service']:"";
    //        // $examination->question_weight = isset($input['question_weight']) ? $input['question_weight']:"";
    //         $examination->course = isset($input['course']) ? $input['course']:"";
    //         $examination->created_by = isset($input['created_by']) ? $input['created_by']:"";
    //         $examination->question = isset($input['question']) ? $input['question']:"";

    //         $examination->save();

    //        //dd($examination);

    //         log::channel('examination')->info('examination Created : ------> ', ['200' , $examination->toArray() ] );


    //         // Loop through each question and store the corresponding question results.
    //         foreach ($input['question_weight_']  as $key => $value) {

    //              // Create a new AnswerKeys object
    //              $answers = new AnswerKeys();

    //              $answers->question_id =  $examination->id;
    //              $answers->key_choice = $key;
    //              $answers->question_weight = $value;

    //             //  $answers->choices = isset($input['answer_a']) ? $input['answer_a']:"";
    //             //  $answers->choices = isset($input['answer_b']) ? $input['answer_b']:"";
    //             //  $answers->choices = isset($input['answer_c']) ? $input['answer_c']:"";
    //             //  $answers->choices = isset($input['answer_d']) ? $input['answer_d']:"";

    //             if (isset($input['answer_a'])) {
    //                 $answers->choices = $input['answer_a'];
    //                 $answers->is_correct = ($input['is_correct'] == 'a') ? 1 : 0;
    //             }
    //             if (isset($input['answer_b'])) {
    //                 $answers->choices = $input['answer_b'];
    //                 $answers->is_correct = ($input['is_correct'] == 'b') ? 1 : 0;
    //             }
    //             if (isset($input['answer_c'])) {
    //                 $answers->choices = $input['answer_c'];
    //                 $answers->is_correct = ($input['is_correct'] == 'c') ? 1 : 0;
    //             }
    //             if (isset($input['answer_d'])) {
    //                 $answers->choices = $input['answer_d'];
    //                 $answers->is_correct = ($input['is_correct'] == 'd') ? 1 : 0;
    //             }
    //              $answers->created_by = $examination->created_by;

    //             //  dd($answers);
    //             // print_pre($answers, true);

    //               $answers->save();




    //         }

    //         DB::commit();

    //         toast('Question Created successfully','success')->position('top-end');
    //         return redirect('exams/exam_bank');

    //     }catch (\Throwable $e) {

    //         DB::rollBack();
    //         Log::info($e->getMessage() );
    //         throw $e;
    //     }

    // }
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
     */
    public function show($id)
    {
        //
        $questions = ExamsQuestions::find($id);
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
        $questions = ExamsQuestions::find($id);
        $Course = Courses ::all()->toArray();
        $answer = Answers ::all()->toArray();
        $service = Services ::all()->toArray();
        return view('exams/edit_exam',compact('questions','Course','answer','service'));
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
    public function destroy(ExamsQuestions $questions)
    {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            $questions->delete();
        }
        return to_route('exam_bank');
    }
}
