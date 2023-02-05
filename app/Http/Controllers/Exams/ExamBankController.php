<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Answers;
use App\Models\Services;
use App\Models\ExamsQuestions;
use Datatables;
use Illuminate\Support\Facades\DB;
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
        $examquestion = ExamsQuestions::select('exams_questions.id','exams_questions.question','exams_questions.answer_key',
                                            'exams_questions.question_weight','exams_questions.course','exams_questions.service', 'exams_questions.created_at','answers.answer_name','services.service_name','courses.course_name')
                                            ->join('answers','answers.id','=','exams_questions.answer_key')
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
    public function store(Request $request)
    {
        $input = $request->all();

        // print_pre( [$input], true);

        // dd($input);

        $request->validate([
            'service'=>'required',
            'question_weight'=>'required',
            'course'=>'required',
            'answer_key'=>'required',
            'question'=>'required',
            'answer_a'=>'required',
            'answer_b'=>'required',
            'answer_c'=>'required',
            'answer_d'=>'required',
        ]);

        try{

            DB::beginTransaction();
            $examination = new ExamsQuestions();
            $examination->service = isset($input['service']) ? $input['service']:"";
            $examination->question_weight = isset($input['question_weight']) ? $input['question_weight']:"";
            $examination->course = isset($input['course']) ? $input['course']:"";
            $examination->answer_key = isset($input['answer_key']) ? $input['answer_key']:"";
            $examination->question = isset($input['question']) ? $input['question']:"";
            $examination->answer_a = isset($input['answer_a']) ? $input['answer_a']:"";
            $examination->answer_b = isset($input['answer_b']) ? $input['answer_b']:"";
            $examination->answer_c = isset($input['answer_c']) ? $input['answer_c']:"";
            $examination->answer_d = isset($input['answer_d']) ? $input['answer_d']:"";

            $examination->save();

            log::channel('examination')->info('examination Created : ------> ', ['200' , $examination->toArray() ] );

            DB::commit();

            return redirect('exams/exam_bank');

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
