<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flat;
use App\Payment;
use App\Service;
use App\Address;
use Carbon\Carbon;
use App\View;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
    {

        // se la richiesta è di tipo ajax
        if($request->ajax())
        {


            
            
            $data= $_GET['lat'];

            $lat= $data[0];
            $lng= $data[1];

            if($lat != '' && $lng != '')
            {
                $latitudeFrom = $lat;
                $longitudeFrom = $lng;
                $earthRadius =  6371;
                $addressInRadius=[];            //6371000 metri

                $addresses = Address::all();
                $service = Service::all();
        

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
                    
                    $indirizzi=[];
                    // confrontare i flatsInRadius address_id con gli id di address e prendere gli address con lo stesso id
                    for ($i=0; $i < count($flatsInRadius); $i++) { 
                        foreach($addresses as $address){
                            if($address->id == $flatsInRadius[$i]['address_id']){
                                array_push($indirizzi,$address);
                                /* $i= array_merge($indirizzi,$flatsInRadius); */
                            }
                        }
                    }

                    // mostrare tutti i servizi per gli appartamenti di ricerca
                    /* foreach($flatsInRadius->services as $service){
                        $serviceApp = $service->service;
                    } */ 


                   // ritorno gli indirizzi e gli appartamenti
                   $obj = [                    
                        'flats' => $flatsInRadius,
                        'addresses' => $indirizzi,
                        /* 'service' => $serviceApp */
                    ];
            
                return $obj;
                //return response()->json($flatsInRadius);
            }
        } // chiusura  if($request->ajax())


        $lat = $_GET['query_lat'];
        $lng = $_GET['query_lng'];
        $city = $_GET['city'];

        #dd($city);



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

        // filtro per appartamenti sponsorizzati
        $momentoAttuale = Carbon::now()->setTimezone('Europe/Rome');            // memorizzo in una var data e ora attuale, nello stesso formato del created_at
        $sponsAttive = Payment::all()->where('end_rate', '>', $momentoAttuale); // memorizzo in una var tutti i pagamenti con end_rate successivo al momento attuale (vuol dire che sono sponsorizzati)
        $flatsIdSpons = [];                                                     // imposto un array vuoto
        foreach($sponsAttive as $sponsAttiva){
            array_push($flatsIdSpons, $sponsAttiva->flat_id);                   // memorizzo nell'array vuoto tutti gli id degli appartamenti sponsorizzati
        }
        $flatsSpons = Flat::all()->whereIn('id', $flatsIdSpons);                // memorizzo in una var tutti gli appartamenti con id contenuto nell'array degli id degli appartamenti sponsorizzati


        
        /* $addresses = Address::where('address','LIKE','%' . strtolower($q) . '%')->get(); */

        // alla view ritorno entrambe le variabili
        return view('search',compact('flatsSpons','service','flatsInRadius','city','lat','lng'));


        // devo tornare qui dalla pagina searh e dirgli di effettuare una ricerca asincrona
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
    // public function show($id)
    function show(Flat $flat, View $view){
        $service = $flat->services;

        // ad ogni visualizzazione della pagina flat genero un record della tabella views e gli assegno il flat_id
        $view['flat_id'] = $flat['id'];
        $view->save();

        return view('flat',compact('flat','service'));
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
    public function update(Request $request, Flat $flat)
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
