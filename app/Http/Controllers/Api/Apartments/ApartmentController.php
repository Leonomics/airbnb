<?php

namespace App\Http\Controllers\Api\Apartments;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Service;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        if($type === 'sponsored') {
            $apartments = Apartment::has('sponsors')->with('sponsors')->get()->toArray();
            $apartmentsFiltered = array_filter($apartments, function ($apartment) {
                $expire_date = null;
                $now = Carbon::now();
                foreach($apartment['sponsors'] as $sponsor) {
                    $expire_date = Carbon::parse($sponsor['pivot']['expire_date']);
                    $lessThan = $now->lessThan($expire_date);
                    if($lessThan) {
                        break;
                    }
                }
                return $lessThan;
            });
            return response()->json([
                'apartments' => $apartmentsFiltered,
                'success' => true
            ]);
        }

        if ($type === 'all'){
            $apartments = Apartment::where('visible', true)->get();
            $service_list = Service::AVAILABLE_SERVICE;

            $apartments->load('sponsors', 'services');
            
            return response()->json([
                'apartments' => $apartments,
                'service_list' => $service_list,
                'success' => true,
            ]);
        }

        if ($type === 'cities'){
            $apartments = Apartment::select('city')->groupBy('city')->havingRaw('COUNT(city) > ?', [3])->get();
            
            return response()->json([
                'apartments' => $apartments,
                'success' => true,
            ]);
        }
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
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $apartment = Apartment::where('id', $id)->with('services', 'images')->first();

        if($apartment){
            return response()->json([
                'apartment' => $apartment,
                'success' => true
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
        // return response()->json([
        //     'apartment' => $apartment,
        //     'success' => true
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
