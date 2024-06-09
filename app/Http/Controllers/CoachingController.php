<?php

namespace App\Http\Controllers;

use App\Models\Coaching;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Jobs\AuditJob;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuditNotification;
use App\Models\Role;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Categories;
use PDF;
use Config;

class CoachingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $coachingForm = Coaching::Select('coachings.id','coachings.agent','coachings.record_id','coachings.supervisor','coachings.quality_analyst','coachings.scores','coachings.results_id',
                                         'coachings.coaching_status','coachings.supervisor_signature'  )
                                      ->where('coachings.results_id','=',$id)
                                      ->first();

                                      $agents = User::where('id','=', $coachingForm['agent'])->first();
                                      $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                                      $supervisor = User::where('id','=', $coachingForm['supervisor'])->first();
                                      $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                                      $qa = User::where('id','=', $coachingForm['quality_analyst'])->first();
                                      $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

                                      $user_id = auth()->user()->id;

                                      $userlogged = User::select('users.name','users.id',)->where('users.id','=',$user_id)->first();


                                      $qualitySignatureUrl= null;

        return view('coaching_forms/index',compact('coachingForm','agents','supervisor','qa','qualitySignatureUrl','userlogged'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category = Categories::select('Categories.id','Categories.category_name',)->get();

        $agentRole_id = Role::select('roles.id',)->where('name', '=', 'Agent')->first();
        $services = Services::select('services.id','services.service_name')->get();


        $user_id = auth()->user()->id;

        $userlogged = User::select('users.name','users.id',)->where('users.id','=',$user_id)->first();

        $supervisorlogged = Role::select('roles.id',)->where('name', '=', 'team-leader')->first();

        $agentlogged = Role::select('roles.id',)->where('name', '=', 'Agent')->first();

        $qualitylogged = Role::select('roles.id',)->where('name', '=', 'quality-analyst')->first();

        $trainierlogged = Role::select('roles.id',)->where('name', '=', 'trainer')->first();

        $agents = User::select('users.name','users.id','model_has_roles.role_id')
                            ->join('model_has_roles','model_id','=','users.id')
                            ->where('model_has_roles.role_id','=',$agentRole_id->id)
                           ->get();
        $coachingview = [];

        $data['coachingview']  = $coachingview;
        $data['category']  = $category;
        $data['agents']  = $agents;
        $data['user_id']  = $user_id;
        $data['supervisorlogged']  = $supervisorlogged;
        $data['agentlogged']  = $agentlogged;
        $data['qualitylogged']  = $qualitylogged;
        $data['trainierlogged']  = $trainierlogged;
        $data['userlogged']  = $userlogged;
        $data['services']= $services;

         //dd($category);

        return view('coaching_forms/view')->with($data);
    }

        /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function coach(Request $request)
    {


        $user_id = auth()->user()->id;

        $category = Categories::select('Categories.id','Categories.category_name','user_categories.user_id')
                                ->join('user_categories','user_categories.category_id','=','Categories.id')
                                ->where('user_categories.user_id','=',$user_id)->get();

        $services = Services::select('services.id','services.service_name')->get();


        $agentRole_id = Role::select('roles.id',)->where('name', '=', 'Agent')->first();


        $userlogged = User::select('users.name','users.id',)->where('users.id','=',$user_id)->first();

        $supervisorlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')
                         ->where('name', '=', 'team-leader')->first();

        $agentlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'Agent')->first();

        $qualitylogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'quality-analyst')->first();

        $trainierlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'trainer')->first();

        $agents = User::select('users.name','users.id','model_has_roles.role_id')
                        ->join('model_has_roles','model_id','=','users.id')
                       ->where('model_has_roles.role_id','=',$agentRole_id->id)
                       ->where('users.id','=',$user_id)
                        ->get();

        $input = $request->all();

        $agent = $request->input('agent');

      //  $categoryname = $request->input('category');

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];


        $coachingview = Coaching::Select('coachings.id','coachings.agent','coachings.record_id','coachings.supervisor','coachings.quality_analyst','coachings.scores','coachings.results_id',
                                       'coachings.date_coaching','coachings.scores', 'coachings.coaching_status','coachings.areas_of_strength','coachings.pervious_actions','coachings.current_areas_improvement','coachings.action_points_taken','coachings.agent_signature','coachings.agent_date_sign','coachings.supervisor_signature','coachings.supervisor_date_sign','coachings.quality_analyst_signature','coachings.quality_analyst_date_sign','coachings.created_at',
                                      // 'user_categories.category_id'
                                       )
                               // ->join('user_categories','user_categories.user_id','=','coachings.agent')
                                ->where('coachings.agent','=',$agent )
                              //  ->where('user_categories.category_id','=',$categoryname)
                                //->where('coachings.results_id','=',$results_id)
                                ->where('coachings.created_at','>=',$start_date)
                                ->where('coachings.created_at','<=',$end_date)
                               ->get();

        foreach($coachingview as $key => $value){

                                $agentName = User::where('id','=', $value['agent'])->first();
                                $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                                $SupervisorName = User::where('id','=', $value['supervisor'])->first();
                                $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                                $qualityName = User::where('id','=', $value['quality_analyst'])->first();
                                $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

                            }

                            $data['category']  = $category;
                            $data['coachingview']  = $coachingview;
                            $data['agents']  = $agents;
                            $data['user_id']  = $user_id;
                            $data['supervisorlogged']  = $supervisorlogged;
                            $data['agentlogged']  = $agentlogged;
                            $data['qualitylogged']  = $qualitylogged;
                            $data['trainierlogged']  = $trainierlogged;
                            $data['userlogged']  = $userlogged;
                            $data['services']= $services;

                          //  dd($data);


                            return view('coaching_forms/view')->with($data);
    }

            /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function qualityCoach(Request $request)
    {


        $user_id = auth()->user()->id;

        $category = Categories::select('Categories.id','Categories.category_name')->get();

        $services = Services::select('services.id','services.service_name')->get();

        $agentRole_id = Role::select('roles.id',)->where('name', '=', 'Agent')->first();

        $userlogged = User::select('users.name','users.id',)->where('users.id','=',$user_id)->first();

        $supervisorlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')
                         ->where('name', '=', 'team-leader')->first();

        $agentlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'Agent')->first();

        $qualitylogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'quality-analyst')->first();

        $trainierlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'trainer')->first();

        $agents = User::select('users.name','users.id','model_has_roles.role_id')
                        ->join('model_has_roles','model_id','=','users.id')
                       ->where('model_has_roles.role_id','=',$agentRole_id->id)
                        ->get();

        $input = $request->all();

        $agent = $request->input('agent');
        $categoryName = $request->input('category');
        $service = $request->input('service');
        $supervisor = $request->input('supervisor');

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];


        $coachingview = Coaching::Select('coachings.id','coachings.agent','coachings.record_id','coachings.supervisor','coachings.quality_analyst',
                                      'coachings.scores','coachings.results_id','coachings.category_id','coachings.date_coaching','coachings.scores', 'coachings.coaching_status','coachings.areas_of_strength','coachings.pervious_actions','coachings.current_areas_improvement','coachings.action_points_taken','coachings.agent_signature','coachings.agent_date_sign','coachings.supervisor_signature','coachings.supervisor_date_sign','coachings.quality_analyst_signature','coachings.quality_analyst_date_sign','coachings.created_at'
                                       )
                                 ->where('coachings.agent','=',$agent )
                                 ->where('coachings.category_id','=',$categoryName)
                                ->where('coachings.supervisor','=',$supervisor)
                                ->where('coachings.created_at','>=',$start_date)
                                ->where('coachings.created_at','<=',$end_date)
                                ->get();
        foreach($coachingview as $key => $value){

                                $agentName = User::where('id','=', $value['agent'])->first();
                                $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                                $SupervisorName = User::where('id','=', $value['supervisor'])->first();
                                $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                                $qualityName = User::where('id','=', $value['quality_analyst'])->first();
                                $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

                            }

                            $data['category']  = $category;
                            $data['coachingview']  = $coachingview;
                            $data['agents']  = $agents;
                            $data['user_id']  = $user_id;
                            $data['supervisorlogged']  = $supervisorlogged;
                            $data['agentlogged']  = $agentlogged;
                            $data['qualitylogged']  = $qualitylogged;
                            $data['trainierlogged']  = $trainierlogged;
                            $data['userlogged']  = $userlogged;
                            $data['services']= $services;

                          //  dd($data);


                            return view('coaching_forms/view')->with($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input =$request->all();

        $id= $request->input('id');


        try {
             // Begin a database transaction.
             DB::beginTransaction();
             $newCoachingForm = Coaching::where('id','=',$id)->first();
             $newCoachingForm->title = isset($input['title']) ? $input['title'] : "";
             $newCoachingForm->date_coaching = isset($input['date_coaching']) ? Carbon::parse($input['date_coaching'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
             $newCoachingForm->areas_of_strength = isset($input['areas_of_strength']) ? $input['areas_of_strength'] :"";
             $newCoachingForm->pervious_actions = isset($input['previous_actions']) ? $input['previous_actions'] :"";
             $newCoachingForm->current_areas_improvement = isset($input['current_improvement']) ? $input['current_improvement'] :"";
             $newCoachingForm->coaching_status = 1;
             $newCoachingForm->quality_analyst_signature = isset($input['quality_signature']) ? $input['quality_signature'] :"";
             $newCoachingForm->quality_analyst_date_sign = isset($input['date_qa_sign']) ? Carbon::parse($input['date_qa_sign'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
             $newCoachingForm->created_by = Auth::user()->id;
            // $newCoachingForm->action_points_taken = isset($input['action_taken']) ? $input['action_taken'] :"";
            // $newCoachingForm->agent_signature = isset($input['agent_signature']) ? $input['agent_signature'] :"";
            // $newCoachingForm->agent_date_sign = isset($input['date_agent_sign']) ? $input['date_agent_sign'] :"";

            // dd($newCoachingForm );
            $newCoachingForm->save();

            log::channel('coachingform')->info('coaching form Created : ------> ', ['200' , $newCoachingForm->toArray() ] );

            DB::commit();

            toast('Coaching Form Updated', 'success')->position('top-end');

            return redirect()->to('coaching_forms/show/'.$newCoachingForm->id.'/'.$newCoachingForm->results_id);


        } catch (\Throwable $e) {

                DB::rollBack();
                Log::info($e->getMessage() );
                throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\id  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $results_id)
    {

        $coachingShow = Coaching::Select('coachings.id','coachings.agent','coachings.record_id','coachings.supervisor','coachings.quality_analyst','coachings.scores','coachings.results_id','coachings.date_coaching','coachings.scores','coachings.areas_of_strength','coachings.pervious_actions','coachings.current_areas_improvement','coachings.action_points_taken','coachings.agent_signature','coachings.agent_date_sign','coachings.supervisor_signature','coachings.supervisor_date_sign','coachings.quality_analyst_signature','coachings.quality_analyst_date_sign')
                                ->where('coachings.id','=',$id)
                                ->where('coachings.results_id','=',$results_id)
                                 ->first();


        $agents = User::where('id','=', $coachingShow['agent'])->first();
        $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';


        $supervisor = User::where('id','=', $coachingShow['supervisor'])->first();
        $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

        $qa = User::where('id','=', $coachingShow['quality_analyst'])->first();
        $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

        return view('coaching_forms/show',compact('coachingShow','agents','supervisor','qa'));
    }

    public function generatePDF($id,$results_id)
    {
        $coachingShow = Coaching::Select('coachings.id','coachings.agent','coachings.record_id','coachings.supervisor','coachings.quality_analyst','coachings.scores',
                                       'coachings.results_id','coachings.date_coaching','coachings.scores','coachings.areas_of_strength','coachings.pervious_actions','coachings.current_areas_improvement',
                                       'coachings.action_points_taken','coachings.agent_signature','coachings.agent_date_sign','coachings.supervisor_signature','coachings.supervisor_date_sign','coachings.quality_analyst_signature','coachings.quality_analyst_date_sign')
                                ->where('coachings.id','=',$id)
                                ->where('coachings.results_id','=',$results_id)
                                 ->get();
        foreach ($coachingShow as $key => $value) {

            $agents = User::where('id','=', $value['agent'])->first();
            $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

            $supervisor = User::where('id','=', $value['supervisor'])->first();
            $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

            $qa = User::where('id','=', $value['quality_analyst'])->first();
            $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';
        }

        // print_pre($agents->name,true);


        $data = ['coachingShow' => $coachingShow,'agents' => $agents, 'supervisor' => $supervisor,'qa' => $qa ];

        $pdf = PDF::loadView('coaching_forms/coaching_pdf', $data); // Use a separate Blade view for PDF content

          // Set paper size to A4
         $pdf->setPaper('a4', 'portrait');

        return $pdf->download('coaching_form.pdf');



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coaching  $coaching
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $coachingShow = Coaching::Select('coachings.id','coachings.agent','coachings.record_id','coachings.supervisor','coachings.quality_analyst','coachings.scores','coachings.results_id',
                                       'coachings.date_coaching','coachings.scores','coachings.areas_of_strength','coachings.pervious_actions','coachings.current_areas_improvement','coachings.action_points_taken','coachings.agent_signature','coachings.agent_date_sign','coachings.supervisor_signature','coachings.supervisor_date_sign','coachings.quality_analyst_signature','coachings.quality_analyst_date_sign')
                            ->where('coachings.id','=',$id)
                              // ->where('coachings.results_id','=',$results_id)
                               ->first();


                   $agents = User::where('id','=', $coachingShow['agent'])->first();
                   $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';


               $supervisor = User::where('id','=', $coachingShow['supervisor'])->first();
               $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

               $qa = User::where('id','=', $coachingShow['quality_analyst'])->first();
               $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

               $supervisorSignatureUrl =null;

        return view('coaching_forms/edit',compact('coachingShow','agents','supervisor','qa','supervisorSignatureUrl'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coaching  $coaching
     * @return \Illuminate\Http\Response
     */
    public function agentEdit($id)
    {

        $coachingShow = Coaching::Select('coachings.id','coachings.agent','coachings.record_id','coachings.supervisor','coachings.quality_analyst','coachings.scores','coachings.results_id',
                                       'coachings.date_coaching','coachings.scores','coachings.areas_of_strength','coachings.pervious_actions','coachings.current_areas_improvement','coachings.action_points_taken','coachings.agent_signature','coachings.agent_date_sign','coachings.supervisor_signature','coachings.supervisor_date_sign','coachings.quality_analyst_signature','coachings.quality_analyst_date_sign')
                            ->where('coachings.id','=',$id)
                               ->get();
            foreach ($coachingShow as $key => $value) {

                // dd($value);
                $agents = User::where('id','=', $value['agent'])->first();
                $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';


               $supervisor = User::where('id','=', $value['supervisor'])->first();
               $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

               $qa = User::where('id','=', $value['quality_analyst'])->first();
               $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';
            }

               $agentSignatureUrl =null;

        return view('coaching_forms.agent_edit', ['id' => $id],compact('coachingShow','agentSignatureUrl','agents','supervisor','qa'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coaching  $coaching
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();
            $updateagentcoaching = Coaching::where('id','=',$id)->first();
            $updateagentcoaching->action_points_taken = isset($input['agent_action']) ? $input['agent_action']:"";
            $updateagentcoaching->agent_date_sign = isset($input['agent_date_sign']) ? Carbon::parse($input['agent_date_sign'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
            $updateagentcoaching->agent_signature  = isset($input['agent_signature']) ? $input['agent_signature']:"";
            $updateagentcoaching->coaching_status='3';
            $updateagentcoaching->created_by = Auth::user()->id;

            $updateagentcoaching->save();

            log::channel('agentsignCoachingForm')->info('agent signed coaching : ------> ', ['200' , $updateagentcoaching->toArray() ] );

            DB::commit();

            return redirect('coaching_forms/show/'.$updateagentcoaching->id.'/'.$updateagentcoaching->results_id);

        } catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
            toast('Something Went Wrong','warning')->position('top-end');
        }
    }

    /**
     * Update the specified resource from storage.
     *
     * @param  \App\Models\Coaching  $coaching
     * @return \Illuminate\Http\Response
     */
    public function supervisorUpdate(Request $request, $id)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();
            $updatecoaching = Coaching::where('id','=',$id)->first();
            $updatecoaching->supervisor_signature = isset($input['supervisor_signature']) ? $input['supervisor_signature']:"";
            $updatecoaching->supervisor_date_sign = isset($input['dateOfSupevisor']) ? Carbon::parse($input['dateOfSupevisor'])->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
            $updatecoaching->coaching_status='2';
            $updateagentcoaching->created_by = Auth::user()->id;

            $updatecoaching->save();

            log::channel('supervisorsignCoachingForm')->info('supervisor signed Coaching: ------> ', ['200' , $updatecoaching->toArray() ] );

            DB::commit();

            return redirect('coaching_forms/show/'.$updatecoaching->id.'/'.$updatecoaching->results_id);

        } catch (\Throwable $e) {

            DB::rollBack();
            Log::info($e->getMessage() );
            throw $e;
            toast('Something Went Wrong','warning')->position('top-end');
        }
    }

        /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function supervisor(Request $request)
    {


        $user_id = auth()->user()->id;

        $category = Categories::select('Categories.id','Categories.category_name','user_categories.user_id')
                                ->join('user_categories','user_categories.category_id','=','Categories.id')
                                ->where('user_categories.user_id','=',$user_id)->get();

        $services = Services::select('services.id','services.service_name')->get();


        $agentRole_id = Role::select('roles.id',)->where('name', '=', 'Agent')->first();


        $userlogged = User::select('users.name','users.id',)->where('users.id','=',$user_id)->first();

        $supervisorlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')
                         ->where('name', '=', 'team-leader')->first();

        $agentlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'Agent')->first();

        $qualitylogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'quality-analyst')->first();

        $trainierlogged = Role::select('roles.id','model_has_roles.model_id')->join('model_has_roles','role_id','=','roles.id')->where('name', '=', 'trainer')->first();

        $agents = User::select('users.name','users.id','model_has_roles.role_id')
                        ->join('model_has_roles','model_id','=','users.id')
                       ->where('model_has_roles.role_id','=',$agentRole_id->id)
                       ->where('users.id','=',$user_id)
                        ->get();

        $input = $request->all();

        $agent = $request->input('agent');
        $categoryName = $request->input('category');
        $service = $request->input('service');
        $supervisor = $request->input('supervisor');

        $start_end_date = explode(' - ', $request->input('created_at'));
        $start_date = $start_end_date[0];
        $end_date = $start_end_date[1];


        $coachingview = Coaching::Select('coachings.id','coachings.agent','coachings.record_id','coachings.supervisor','coachings.quality_analyst',
                                       'coachings.scores','coachings.results_id','coachings.category_id', 'coachings.date_coaching','coachings.scores', 'coachings.coaching_status','coachings.areas_of_strength','coachings.pervious_actions','coachings.current_areas_improvement','coachings.action_points_taken','coachings.agent_signature','coachings.agent_date_sign','coachings.supervisor_signature','coachings.supervisor_date_sign','coachings.quality_analyst_signature','coachings.quality_analyst_date_sign','coachings.created_at',

                                       )
                                ->where('coachings.agent','=',$agent )
                                ->where('coachings.category_id','=',$categoryName)
                                ->where('coachings.supervisor','=',$supervisor)
                                ->where('coachings.created_at','>=',$start_date)
                                ->where('coachings.created_at','<=',$end_date)
                               ->get();

        foreach($coachingview as $key => $value){

                                $agentName = User::where('id','=', $value['agent'])->first();
                                $value['agentName'] =  isset($agentName)  ?  $agentName->name : '';

                                $SupervisorName = User::where('id','=', $value['supervisor'])->first();
                                $value['SupervisorName'] =  isset($SupervisorName)  ?  $SupervisorName->name : '';

                                $qualityName = User::where('id','=', $value['quality_analyst'])->first();
                                $value['qualityName'] =  isset($qualityName)  ?  $qualityName->name : '';

                            }

                            $data['category']  = $category;
                            $data['coachingview']  = $coachingview;
                            $data['agents']  = $agents;
                            $data['user_id']  = $user_id;
                            $data['supervisorlogged']  = $supervisorlogged;
                            $data['agentlogged']  = $agentlogged;
                            $data['qualitylogged']  = $qualitylogged;
                            $data['trainierlogged']  = $trainierlogged;
                            $data['userlogged']  = $userlogged;
                            $data['services']= $services;


                            return view('coaching_forms/view')->with($data);
    }
}
