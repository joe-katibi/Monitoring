<?php

namespace App\Http\Controllers;
use Datatables;
use Carbon\Carbon;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Result;
use App\Models\User;
use App\Models\Briefs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $briefs = Briefs::select('briefs.brief_topic','briefs.created_by','briefs.brief_description','briefs.created_by','briefs.status','briefs.created_at','briefs.id','users.name')
                           ->join('users','users.id','=','briefs.created_by')->get();
        $briefView = Briefs::select('briefs.brief_topic','briefs.created_by','briefs.brief_description','briefs.created_by','briefs.status','briefs.created_at','briefs.id','users.name')
                             ->join('users','users.id','=','briefs.created_by')
                             ->where('briefs.status','=', 1)
                             ->get();


        $services = ['DTH', 'Cable'];
        $countries = ['Kenya', 'Uganda', 'Tanzania', 'Zambia', 'Malawi'];
        $currentMonth = Carbon::now()->format('Y-m');

        $agents = [];

        foreach ($countries as $country) {
            $countryId = Countries::where('country_name', $country)->value('id');

            foreach ($services as $service) {
                $serviceId = Services::where('service_name', $service)->value('id');

                $serviceData = User::select(
                    'users.*',
                    'users.name as agent_name',
                    'countries.country_name as country_name',
                    'departments.description as department_name',
                    'services.service_name as service_name',
                  //  'users.profile_image',
                    'upload_calls.call_file'
                )
                ->join('upload_calls', 'upload_calls.agent_name', '=', 'users.id')
                ->join('countries', 'users.country', '=', 'countries.id')
                ->join('user_categories', 'user_categories.user_id', '=', 'users.id')
                ->join('categories', 'categories.id', '=', 'user_categories.category_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->join('services', 'services.id', '=', 'users.services')
                ->where('upload_calls.call_rating', 1)
                ->where('users.services', $serviceId)
                ->where('countries.country_name', $country)
                ->whereMonth('upload_calls.created_at', Carbon::now()->month)
                ->take(1)
                ->get();

                if ($serviceData->isNotEmpty()) {
                    $agents[$country][$service] = $serviceData;
                }
            }

                           // Get the current date
                           $currentDate = Carbon::now();

                           // Calculate the start and end dates for the weeks
                           $startOfWeek = $currentDate->copy()->subWeeks(10)->startOfWeek();
                           $endOfWeek = $currentDate->copy()->endOfWeek();

                           // Calculate the start and end dates for the months
                           $startOfMonth = $currentDate->copy()->startOfMonth()->subMonths(12);
                           $endOfMonth = $currentDate->copy()->endOfMonth();

    // Retrieve the results from the database for the specified date range
    $results = Result::select('results.agent_name', 'results.final_results', 'results.created_at', 'users.country', 'countries.country_name','services.service_name')
        ->join('users', 'users.id', '=', 'results.agent_name')
        ->join('countries', 'countries.id', '=', 'users.country')
        ->join('services', 'services.id', '=', 'users.services')
        ->whereBetween('results.created_at', [$startOfWeek, $endOfWeek])
        ->orWhereBetween('results.created_at', [$startOfMonth, $endOfMonth])
        ->orderBy('results.created_at')
        ->get();

    $averages = [];

    foreach ($results as $result) {
        $countryName = $result->country_name;
        $serviceName = $result->service_name;
        $date = Carbon::parse($result->created_at);

        $weekNumber = $date->weekOfYear;
        if (!isset($averages[$countryName][$serviceName]['weeks'][$weekNumber])) {
            $averages[$countryName][$serviceName]['weeks'][$weekNumber] = [];
        }
        $averages[$countryName][$serviceName]['weeks'][$weekNumber][] = $result->final_results;

        $monthYear = $date->format('F Y');
        if (!isset($averages[$countryName][$serviceName]['months'][$monthYear])) {
            $averages[$countryName][$serviceName]['months'][$monthYear] = [];
        }
        $averages[$countryName][$serviceName]['months'][$monthYear][] = $result->final_results;
    }


    $weekHeaders = [];
    $monthHeaders = [];

    if (!empty($averages)) {
        $firstCountry = array_key_first($averages);
        if ($firstCountry !== null) {
            $firstService = array_key_first($averages[$firstCountry]);
            if ($firstService !== null) {
                // Week Headers
                if (isset($averages[$firstCountry][$firstService]['weeks'])) {
                    $weekHeaders = array_keys($averages[$firstCountry][$firstService]['weeks']);
                }

                // Month Headers
                if (isset($averages[$firstCountry][$firstService]['months'])) {
                    $monthHeaders = array_keys($averages[$firstCountry][$firstService]['months']);
                }
            }
        }
    }

    foreach ($averages as $country => $services) {
        foreach ($services as $service => $data) {
            foreach ($weekHeaders as $week) {
                if (!isset($data['weeks'][$week])) {
                    $averages[$country][$service]['weeks'][$week] = 0;
                }
            }

            foreach ($monthHeaders as $month) {
                if (!isset($data['months'][$month])) {
                    $averages[$country][$service]['months'][$month] = 0;
                }
            }

            foreach ($data['weeks'] as $week => $values) {
                $averages[$country][$service]['weeks'][$week] = count($values) > 0 ? round(array_sum($values) / count($values), 2) : 0;
            }

            foreach ($data['months'] as $month => $values) {
                $averages[$country][$service]['months'][$month] = count($values) > 0 ? round(array_sum($values) / count($values), 2) : 0;
            }
        }
    }

                           return view('home', compact('agents', 'briefs', 'briefView', 'results', 'weekHeaders', 'monthHeaders', 'averages'));


        }



    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            // Save the image path to the database for the agent
            // You may need to adjust this code based on your database structure and model relationships

            return response()->json(['success' => 'Image uploaded successfully']);
        }

        return response()->json(['error' => 'Image upload failed']);
    }

    public function addBrief(Request $request)
    {
        $brief = $request->input('brief');

        // Save the brief to the database or perform any other necessary action

        return response()->json(['success' => 'Brief added successfully']);
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

        try {
             DB::beginTransaction();
             $brief = new Briefs();

            $brief->brief_topic = isset($input['brief_topic']) ? $input['brief_topic']:"";
            $brief->brief_description = isset($input['brief_description']) ? $input['brief_description']:"";
            $brief->created_by = Auth::user()->id;
            $brief->status = 1;

            $brief->save();

            log::channel('brief')->info('new brief Created : ------> ', ['200' , $brief->toArray() ] );

             DB::commit();

            toast('Brief Created successfully','success')->position('top-end');
            return back();

        } catch (\Exception $e) {
            Log::info($e->getMessage());
            toast('Brief Not Created Successfully')->position('top-end');
            return back();
        }
    }

    public function activate($id)
    {
        /** @var Briefs $Briefs */
        $brief = Briefs::findOrFail($id);

        $brief->status = 1;

        $brief->save();

        return back();
    }

    public function deactivate($id)
    {
        /** @var Briefs $Briefs */

        $brief = Briefs::findOrFail($id);

        $brief->status = 0;

        $brief->save();

        return back();
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Briefs  $Briefs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $briefView = Briefs::select('briefs.brief_topic','briefs.created_by','briefs.brief_description','briefs.created_by','briefs.status','briefs.created_at','briefs.id','users.name')
                             ->join('users','users.id','=','briefs.created_by')
                             ->where('briefs.id','=', $id)
                             ->get();

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
        $input = $request->all();

        try
        {
           DB::beginTransaction();
           $brief = Briefs::where('id','=',$id)->first();
           $brief->brief_topic = isset($input['brief_topic']) ? $input['brief_topic']:"";
           $brief->brief_description = isset($input['brief_description']) ? $input['brief_description']:"";
           $brief->created_by = Auth::user()->id;
           $brief->status = 1;

           $brief->save();

           log::channel('brief')->info('brief edited : ------> ', ['200' , $brief->toArray() ] );

            DB::commit();

           toast('Brief Edited successfully','success')->position('top-end');
           return back();

        } catch (\Exception $e) {
           Log::info($e->getMessage());
           toast('Brief Not edited Successfully')->position('top-end');
           return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function show()
{
    // Get the current date
    $currentDate = Carbon::now();

    // Calculate the start and end dates for the weeks
    $startOfWeek = $currentDate->copy()->subWeeks(10)->startOfWeek();
    $endOfWeek = $currentDate->copy()->endOfWeek();

    // Calculate the start and end dates for the months
    $startOfMonth = $currentDate->copy()->startOfMonth()->subMonths(12);
    $endOfMonth = $currentDate->copy()->endOfMonth();

    // Retrieve the results from the database for the specified date range
    $results = Result::select('results.agent_name', 'results.final_results', 'results.created_at', 'users.country', 'countries.country_name','services.service_name')
        ->join('users', 'users.id', '=', 'results.agent_name')
        ->join('countries', 'countries.id', '=', 'users.country')
        ->join('services', 'services.id', '=', 'users.services')
        ->whereBetween('results.created_at', [$startOfWeek, $endOfWeek])
        ->orWhereBetween('results.created_at', [$startOfMonth, $endOfMonth])
        ->orderBy('results.created_at')
        ->get();

    $averages = [];

    foreach ($results as $result) {
        $countryName = $result->country_name;
        $serviceName = $result->service_name;
        $date = Carbon::parse($result->created_at);

        $weekNumber = $date->weekOfYear;
        if (!isset($averages[$countryName][$serviceName]['weeks'][$weekNumber])) {
            $averages[$countryName][$serviceName]['weeks'][$weekNumber] = [];
        }
        $averages[$countryName][$serviceName]['weeks'][$weekNumber][] = $result->final_results;

        $monthYear = $date->format('F Y');
        if (!isset($averages[$countryName][$serviceName]['months'][$monthYear])) {
            $averages[$countryName][$serviceName]['months'][$monthYear] = [];
        }
        $averages[$countryName][$serviceName]['months'][$monthYear][] = $result->final_results;
    }

    $weekHeaders = [];
    $monthHeaders = [];

    if (!empty($averages)) {
        $firstCountry = array_key_first($averages);
        if ($firstCountry !== null) {
            $firstService = array_key_first($averages[$firstCountry]);
            if ($firstService !== null) {
                // Week Headers
                if (isset($averages[$firstCountry][$firstService]['weeks'])) {
                    $weekHeaders = array_keys($averages[$firstCountry][$firstService]['weeks']);
                }

                // Month Headers
                if (isset($averages[$firstCountry][$firstService]['months'])) {
                    $monthHeaders = array_keys($averages[$firstCountry][$firstService]['months']);
                }
            }
        }
    }

    foreach ($averages as $country => $services) {
        foreach ($services as $service => $data) {
            foreach ($weekHeaders as $week) {
                if (!isset($data['weeks'][$week])) {
                    $averages[$country][$service]['weeks'][$week] = 0;
                }
            }

            foreach ($monthHeaders as $month) {
                if (!isset($data['months'][$month])) {
                    $averages[$country][$service]['months'][$month] = 0;
                }
            }

            foreach ($data['weeks'] as $week => $values) {
                $averages[$country][$service]['weeks'][$week] = count($values) > 0 ? round(array_sum($values) / count($values), 2) : 0;
            }

            foreach ($data['months'] as $month => $values) {
                $averages[$country][$service]['months'][$month] = count($values) > 0 ? round(array_sum($values) / count($values), 2) : 0;
            }
        }
    }

    return view('home2', compact('results', 'weekHeaders', 'monthHeaders', 'averages'));
}


}

