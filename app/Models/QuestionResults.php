<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Result;
use App\Models\QuestionResults;
use App\Models\FiberWelcomeQuestion;

class QuestionResults extends Model
{
    use HasFactory;

    protected $fillable=[
        'results',
        'question_no',
        'marks',
        'create_by',

    ];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];

    public static function get_results_details($results_details_id){



          $results_details = Result::select('results.supervisor','results.agent_name','results.date_recorded','results.quality_analysts',
                                  'results.customer_account','results.recording_id','results.qa_call_category','results.qa_call_nature','results.results',
                                  'results.agent_call_category','results.agent_call_nature','results.general_issue','results.specific_issue',
                                  'results.feedback_from_qc','results.category', 'results.id','results.results')

                                //  ->join('fiber_welcome_questions','fiber_welcome_questions.category','=','results.category')

                                  ->where('results.id', '=', $results_details_id)->get();

                                  return $results_details;

    }

    public static function get_results_marks($question_marks_id){

        // dd($question_marks_id);

        $results_marks = QuestionResults::select('question_results.id','question_results.results','question_results.marks',
                                                 'question_results.question_no',
                                                 'fiber_welcome_questions.id','fiber_welcome_questions.question'
                                                 )
                                                 // ->join('results','results.id','=','question_results.results')
                                                  ->join('fiber_welcome_questions','fiber_welcome_questions.id','=','question_results.question_no')

                                                 ->where('question_results.results', '=', $question_marks_id)->get();

                                                 return $results_marks;
    }
    //select two tables and query



    // public static function get_question($question_id){

    //     $question = FiberWelcomeQuestion::select('fiber_welcome_questions.number','fiber_welcome_questions.question','fiber_welcome_questions.category')
    //                                                     ->join('results','results.category','=','fiber_welcome_questions.category')
    //                                                     ->join('question_results','question_results.question_no','=','fiber_welcome_questions.number')
    //                                              ->where('fiber_welcome_questions.number', '=', $question_id)->get();

    //                                              return $question;
    // }
}
