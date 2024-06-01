<?php

namespace App\Http\Controllers\CElinks;

use Datatables;
use App\Models\Links;
use App\Models\Services;
use App\Models\Countries;
use App\Models\SystemLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CELinksController extends Controller
{

    public function index()
    {
        $countries = Countries::select('id', 'country_name')->get();
        $countryMap = $countries->keyBy('id')->toArray();
        $service = Services::all()->toArray();

        // Fetching links with the related services and countries
        $links = SystemLink::select(
            'system_links.id',
            'system_links.site_name as name',
            'system_links.site_url as url',
            'system_links.site_image as image',
            'countries.id as country_id',
            'countries.country_name',
            'services.service_name as service'
        )
        ->join('countries_system_link', 'countries_system_link.system_link_id', '=', 'system_links.id')
        ->join('services_system_link', 'services_system_link.system_link_id', '=', 'system_links.id')
        ->join('countries', 'countries.id', '=', 'countries_system_link.countries_id')
        ->join('services', 'services.id', '=', 'services_system_link.services_id')
        ->get();

        // Transforming data to the desired format
        $sites = $links->map(function ($link) use ($countryMap) {
            return (object) [
                'id' => $link->id,
                'country_id' => $link->country_id,
                'service' => $link->service,
                'name' => $link->name,
                'url' => $link->url,
                'image' => $link->image
            ];
        });

        // Map country names to sites
        $sitesWithCountry = $sites->map(function($site) use ($countryMap) {
            if (isset($site->country_id) && isset($countryMap[$site->country_id])) {
                $site->country_name = $countryMap[$site->country_id]['country_name'];
            } else {
                $site->country_name = 'Unknown';
            }
            return $site;
        });

        $data['countries'] = $countries;
        $data['sites'] = $sitesWithCountry;
        $data['service'] = $service;

        return view('system_links.dashboard_link')->with($data);
    }


    public function show()
    {
        $countries = Countries::select('id', 'country_name')->get();
        $countryMap = $countries->keyBy('id')->toArray();
        $service =Services::all()->toArray();

            // Fetching links with the related services and countries
            $links = SystemLink::select(
                'system_links.id',
                'system_links.site_name as name',
                'system_links.site_url as url',
                'system_links.site_image as image',
                'countries.id as country_id',
                'countries.country_name',
                'services.service_name as service'
            )
            ->join('countries_system_link', 'countries_system_link.system_link_id', '=', 'system_links.id')
            ->join('services_system_link', 'services_system_link.system_link_id', '=', 'system_links.id')
            ->join('countries', 'countries.id', '=', 'countries_system_link.countries_id')
            ->join('services', 'services.id', '=', 'services_system_link.services_id')
            ->get();

            // Transforming data to the desired format
            $sites = $links->map(function ($link) use ($countryMap) {
                return (object) [
                    'id' => $link->id,
                    'country_id' => $link->country_id,
                    'service' => $link->service,
                    'name' => $link->name,
                    'url' => $link->url,
                    'image' => $link->image
                ];
            });

            // Map country names to sites
            $sitesWithCountry = $sites->map(function($site) use ($countryMap) {
                if (isset($site->country_id) && isset($countryMap[$site->country_id])) {
                    $site->country_name = $countryMap[$site->country_id]['country_name'];
                } else {
                    $site->country_name = 'Unknown';
                }
                return $site;
            });



        $data['countries'] = $countries;
        $data['sites'] = $sitesWithCountry;
        $data['service'] = $service;

        return view('welcome')->with($data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        // Uncomment to debug the request data

        // Check if the site image is valid
        if ($request->hasFile('site_image') && $request->file('site_image')->isValid()) {
            // Get the uploaded file
            $site_image = $request->file('site_image');

            // Get the file name and extension
            $filename = $site_image->getClientOriginalName();

            // Move the file to the assets directory
            $site_image->move(public_path('assets/img'), $filename);

            try {
                DB::beginTransaction();

                // Create a new SystemLink instance
                $link = new SystemLink();

                // Assign values from the input array
                $link->site_name = $input['site_name'] ?? "";
                $link->site_url = $input['site_url'] ?? "";
                $link->site_image = 'assets/img/' . $filename; // Save the path of the uploaded image
                $link->link_status = 1;
                $link->created_by = Auth::user()->id;

                // Save the link to get its ID
                $link->save();

                // Sync service IDs (assuming you have a many-to-many relationship defined)
                if (isset($input['service_id']) && is_array($input['service_id'])) {
                    $link->services()->sync($input['service_id']);
                }

                // Sync country IDs (assuming you have a many-to-many relationship defined)
                if (isset($input['country_id']) && is_array($input['country_id'])) {
                    $link->countries()->sync($input['country_id']);
                }

                DB::commit();

                // Display a success message
                toast('System link Uploaded Successfully', 'success')->position('top-end');

                return redirect('system_links/dashboard_link');

            } catch (\Throwable $e) {
                DB::rollBack();
                Log::info($e->getMessage());
                alert()->error('ErrorAlert', 'create link')->footer('<span>Error code:</span>' . $e->getMessage());
                throw $e;
            }
        } else {
            return redirect()->back()->with('error', 'Invalid image upload.');
        }
    }



}
