<?php

namespace App\Http\Controllers\Results\Dth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\FiberWelcomeQuestion;
use App\Models\User;
use App\Models\Role;
use App\Models\AlertForm;
use App\Models\Result;
use App\Models\QuestionResults;
use App\Models\Permission;
use App\Models\Positions;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Categories;
use Carbon\Carbon;
use Datatables;

class DthBillingResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $question_v = Result::find($id)->join('question_results','question_results.results','=','results.id')
                                        ->join('fiber_welcome_questions','fiber_welcome_questions.id','=','question_results.question_no')
                                         ->select('question_results.results','question_results.marks','results.id','results.supervisor',
                                         'results.agent_name','results.quality_analysts','results.date_recorded','results.category',
                                         'results.customer_account','results.recording_id','results.final_results','results.qa_call_category',
                                         'results.qa_call_nature','results.agent_call_category','results.agent_call_nature','results.general_issue',
                                         'results.specific_issue','results.feedback_from_qc','question_results.question_no',
                                         'fiber_welcome_questions.question','fiber_welcome_questions.number',)
                                        ->where('question_results.results','=',$id)
                                        ->get();

         foreach($question_v as $key => $value){

                                            $agentName = User::where('id','=', $value['agent_name'])->first();
                                            $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                                            $SupervisorName = User::where('id','=', $value['supervisor'])->first();
                                            $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                                            $qualityName = User::where('id','=', $value['quality_analysts'])->first();
                                            $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

                                            $createdAt = $value->date_recorded;

                                            $monthName = Carbon::parse($createdAt)->format('F');
                                            $value['monthName'] =  isset($createdAt)  ?  $monthName: '';

                                            $weekNumber = Carbon::parse($createdAt)->format('W');
                                            $weekNumberWithPrefix = "week " . $weekNumber;
                                            $value['weekNumberWithPrefix'] =  isset($createdAt)  ?  $weekNumberWithPrefix: '';

                                        }

                   $data['question_v'] = $question_v;

        return view('results/Dth/dth_billing_results')->with($data);
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
        $question_v = Result::find($id)->join('question_results','question_results.results','=','results.id')
        ->join('fiber_welcome_questions','fiber_welcome_questions.id','=','question_results.question_no')
         ->select('question_results.results','question_results.marks','results.id','results.supervisor',
         'results.agent_name','results.quality_analysts','results.date_recorded','results.category',
         'results.customer_account','results.recording_id','results.final_results','results.qa_call_category',
         'results.qa_call_nature','results.agent_call_category','results.agent_call_nature','results.general_issue',
         'results.specific_issue','results.feedback_from_qc','question_results.question_no',
         'fiber_welcome_questions.question','fiber_welcome_questions.number',)
        ->where('question_results.results','=',$id)
        ->get();


        foreach($question_v as $key => $value){

            $agentName = User::where('id','=', $value['agent_name'])->first();
            $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

            $SupervisorName = User::where('id','=', $value['supervisor'])->first();
            $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

            $qualityName = User::where('id','=', $value['quality_analysts'])->first();
            $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

            $createdAt = $value->date_recorded;

            $monthName = Carbon::parse($createdAt)->format('F');
            $value['monthName'] =  isset($createdAt)  ?  $monthName: '';

            $weekNumber = Carbon::parse($createdAt)->format('W');
            $weekNumberWithPrefix = "week " . $weekNumber;
            $value['weekNumberWithPrefix'] =  isset($createdAt)  ?  $weekNumberWithPrefix: '';

        }

             $data['question_v'] = $question_v;

            // print_pre([$data] , true);


        return view('results/Dth/dth_edit_results')->with($data);
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
             // Retrieve all input data from the request and store it in the $input variable.
             $input = $request->all();

             try {
                  DB::beginTransaction();
                 $results = Result::where('id','=',$id)->first();
                 $results->feedback_from_qc = isset($input['feedback_from_qc']) ? $input['feedback_from_qc'] : "";
                 $results->created_by = Auth::user()->id;
         
                 $results->save();
         
                             // Loop through each question and store the corresponding question results.
                     foreach ($input['question_no_'] as $key => $value) {
         
                         // Create a new QuestionResults object
                         $question_results = QuestionResults::where('results','=',$id)->first();
                         $question_results->marks = $value ;
                         $question_results->created_by = Auth::user()->id;
         
                         // Save the QuestionResults object to the database
                         $question_results->save();
             
                     }
         
                                // Sum up the 'marks' column where 'results' equals $results->id.
                                $totalMarks = QuestionResults::where('results', '=', $id)->sum('marks');
         
                                // Get the Result object for the results
                                $results_update = Result::find($id);
                    
                                // Set the final_results property of the Result object to the total marks
                                $results_update->final_results = $totalMarks;
                    
                                // Update the Result object in the database
                                $results_update->save();
         
                                  // Commit the transaction
                     DB::commit();
         
                     $autofail = QuestionResults::where('results', '=', $id)->where('marks', '=', 'Auto Fail')->first();
         
         
                     // Check if $autofail is null or $autofail->marks is not 'Auto Fail'
                      if (!$autofail || $autofail->marks !== 'Auto Fail') {
                         // Redirect to a different view
                          return redirect('results/billing/billing_results/'.$id);
                       }
          
          
                      // Check if the total marks are 5
                      if ($autofail->marks == 'Auto Fail') {
          
                             // Get the current date and time
                              $currentDateTime = Carbon::today();
          
                         // Calculate the start and end of the current month
                              $startOfMonth = Carbon::now()->startOfMonth();
                             $endOfMonth = Carbon::now()->endOfMonth();
          
                     // Format the date in 'Y-m-d' format
                             $startOfMonthDate = $startOfMonth->format('Y-m-d');
                             $endOfMonthDate = $endOfMonth->format('Y-m-d');
          
                       // Fetch the coaching record for the current month
                     $coachingRecord = Coaching::where('agent', '=', $results->agent_name)
                         ->whereRaw("DATE(created_at) >= ?", [$startOfMonthDate])
                         ->whereRaw("DATE(created_at) <= ?", [$endOfMonthDate])
                         ->first();
          
                        // Fetch the result record for the current month
                        $resultRecord = Result::where('agent_name', '=', $results->agent_name)
                         ->whereRaw("DATE(created_at) >= ?", [$startOfMonthDate])
                          ->whereRaw("DATE(created_at) <= ?", [$endOfMonthDate])
                          ->first();
          
                               if ($coachingRecord && $resultRecord) {
                                  // Both records exist for the current month
          
                                 // print_pre($coachingRecord, true);
          
                                  $result = new Result();
                                  $result->agentEmail = $agentEmail;
                                  $result->supervisorEmail = $supervisorEmail;
                                  $result->qualityAnalysts = $qualityAnalysts;
          
                                  $notification = new AuditNotification($result, 'results');
                                  Mail::to($agentEmail->email)
                                      ->cc($supervisorEmail->email)->send($notification);
          
          
                              toast('Auto Fail generated', 'warning')->position('top-end');
                              return redirect()->to('/quality_analyst/qa_agent_alert_form/'.$id);
          
                              } else {
          
                                  // Record not found for the current month in either Coaching or Result table
                                  $coachingForm = new Coaching();
                                  $coachingForm->agent = $results->agent_name;
                                  $coachingForm->record_id = $results->recording_id;
                                  $coachingForm->supervisor =  $results->supervisor;
                                  $coachingForm->quality_analyst = $results->quality_analysts;
                                  $coachingForm->scores = $totalMarks;
                                  $coachingForm->coaching_status = '1';
                                  $coachingForm->results_id = $id;
                                  $coachingForm->category_id = $results->category;
                                  $coachingForm->created_by = Auth::user()->id;
                                  //save required details on coaching DB
          
                                  // dd($totalMarks);
                                  $coachingForm->save();
          
                                  $coachingForm = new Coaching();
                                  $coachingForm->agentEmail = $agentEmail;
                                  $coachingForm->supervisorEmail = $supervisorEmail;
                                  $coachingForm->qualityAnalysts = $qualityAnalysts;
          
                                  $notification = new AuditNotification($coachingForm, 'results');
                                  Mail::to($agentEmail->email)
                                      ->cc($supervisorEmail->email)->send($notification);
          
                              toast('Coaching Form generated', 'info')->position('top-end');
          
                              return redirect()->to('/coaching_forms/index/'.$id);
          
                              }
          
                      } else {
                          // Display a success message if the total marks are not 0
                          $result = new Result();
                          $result->marks = $totalMarks;
                          $result->qualityAnalysts = $qualityAnalysts;
                          $result->agentEmail = $agentEmail;
                          $result->supervisorEmail = $supervisorEmail;
          
                          $notification = new AuditNotification($result, 'results');
                          Mail::to($agentEmail->email)
                              ->cc($supervisorEmail->email)->send($notification);
          
                          toast('Agent Audited successfully', 'success')->position('top-end');
          
                          return redirect('results/billing/billing_results/'.$id);
                      }
          
         
         
             } catch (\Throwable $e) {
                
                 DB::rollBack();
                         Log::info($e->getMessage() );
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
        //
    }
}
