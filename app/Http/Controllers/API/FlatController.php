<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use App\Service;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $lat = $_GET['query_lat'];
        $lng = $_GET['query_lng'];
        dd($lat,$lng);
        $latitudeFrom = $lat;
        $longitudeFrom = $lng;
        $earthRadius =  6371;
        $addressInRadius=[];            //6371000 metri

        $addresses = Address::all();


        foreach ($addresses as $address){
            $latitudeTo = $address->lat;
            $longitudeTo = $address->lng;

            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $lonDelta = $lonTo - $lonFrom;
            $a = pow(cos($latTo) * sin($lonDelta), 2) +
                pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
            $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

            $angle = atan2(sqrt($a), $b);
            $result = $angle * $earthRadius;


            if($result <= 20){
                array_push($addressInRadius, $address->id);
            }
        }

        $flatsInRadius= [];
        $flats = Flat::all();
        for($i=0; $i < count($addressInRadius); $i++){

            foreach($flats as $flat){
                if($flat->address_id == $addressInRadius[$i]){
                    array_push($flatsInRadius, $flat);
                }
            }
        }


        // tutti gli appartamenti, per risultato di ricerca
        $service = Service::all();

        // ritorno entrambe le variabili
        return response()->json($service,$flatsInRadius,200);
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
        //
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
    public function destroy($id)
    {
        //
    }
}
