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

            // prendo i filtri stanza
            if(empty($_GET['room'])){
                $room= '';
            }else{
                $room=$_GET['room'];
            }

            if(empty($_GET['bed'])){
                $bed= '';
            }else{
                $bed=$_GET['bed'];
            }

            if(empty($_GET['wc'])){
                $wc= '';
            }else{
                $wc=$_GET['wc'];
            }

            if(empty($_GET['selectedMq'])){
                $selectedMq= '';
            }else{
                $selectedMq=$_GET['selectedMq'];
                $mq = (int)$selectedMq;
            }


            $data= $_GET['geo'];

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

                if(empty($_GET['serviceList'])){
                    $flatsServices = $flatsInRadius;
                }else{
                    $serviceGet=$_GET['serviceList'];
                    $flatsServices = Flat::whereHas('services', function ($query) {
                        $query->where('service_id',$_GET['serviceList']);
                    })->get(); //-with('services')->get();  #Chiamare a una funzione membro get() sulla stringa
                }

                $serviceRadius = [];

                foreach ($flatsServices as $flatService) {
                    foreach ($flatsInRadius as $flatInRadius) {
                        if($flatService['id'] == $flatInRadius['id'] ){
                            array_push($serviceRadius,$flatInRadius);
                        }
                    }
                }

                // ciclare $flatsInRadius per prendere gli appartamenti filtrati
                $appartamentiFiltrati = [];
                $flatRadius= count($serviceRadius); #$flatsInRadius
                for($i=0; $i < $flatRadius; $i++){ 
                    if($serviceRadius[$i]['bed'] == $bed &&  $serviceRadius[$i]['room'] == $room && $serviceRadius[$i]['wc'] == $wc){        
                        array_push($appartamentiFiltrati, $serviceRadius[$i]);
                    }else if($serviceRadius[$i]['bed'] == $bed ||  $serviceRadius[$i]['room'] == $room || $serviceRadius[$i]['wc'] == $wc){
                        array_push($appartamentiFiltrati, $serviceRadius[$i]);
                    }

                    if(isset($mq)){
                        switch ($mq) {
                            case $mq == 50:
                                if($serviceRadius[$i]['mq'] <= 50){
                                    array_push($appartamentiFiltrati, $serviceRadius[$i]);
                                } 
                                break;
                            case $mq == 100:
                                if($serviceRadius[$i]['mq'] > 50 &&  $serviceRadius[$i]['mq'] <= 100){
                                    array_push($appartamentiFiltrati, $serviceRadius[$i]);
                                } 
                                break;
                            case $mq == 150:
                                if($serviceRadius[$i]['mq'] > 100 &&  $serviceRadius[$i]['mq'] <= 150){
                                    array_push($appartamentiFiltrati, $serviceRadius[$i]);
                                } 
                                break;
                            case $mq == 200:
                                if($serviceRadius[$i]['mq'] > 150 &&  $serviceRadius[$i]['mq'] <= 200){
                                    array_push($appartamentiFiltrati, $serviceRadius[$i]);
                                } 
                                break;
                            case $mq == 250:
                                if($serviceRadius[$i]['mq'] > 200 &&  $serviceRadius[$i]['mq'] <= 250){
                                    array_push($appartamentiFiltrati, $serviceRadius[$i]);
                                } 
                                break;
                            case $mq == 300:
                                if($serviceRadius[$i]['mq'] > 250 &&  $serviceRadius[$i]['mq'] <= 300){
                                    array_push($appartamentiFiltrati, $serviceRadius[$i]);
                                } 
                                break;
                            case $mq > 300:
                                if($serviceRadius[$i]['mq'] > 300){
                                    array_push($appartamentiFiltrati, $serviceRadius[$i]);
                                };
                        } /* chiusura switch */ 
                    }

                    if(empty($appartamentiFiltrati)){
                        $appartamentiFiltrati = $serviceRadius;
                    }
                };

                $indirizzi=[]; // indirizzi degli appartamenti ricercati senza filtro di ricerca
                for($i=0; $i < count($serviceRadius); $i++) {  #flatsInRadius
                    foreach($addresses as $address){
                        if($address->id == $serviceRadius[$i]['address_id']){
                            array_push($indirizzi,$address);
                        }
                    }
                }


                $indirizziAppFiltrati=[]; // indirizzi degli appartamenti ricercati CON filti di ricerca
                for($i=0; $i < count($appartamentiFiltrati); $i++) { 
                    foreach($addresses as $address){
                        if($address->id == $appartamentiFiltrati[$i]['address_id']){
                            array_push($indirizziAppFiltrati,$address);
                        }
                    }
                }


                foreach($appartamentiFiltrati as $appartamento){
                    foreach($indirizziAppFiltrati as $indirizzo){
                        if($appartamento['address_id'] == $indirizzo['id']){
                            $appartamento['description'] = $indirizzo['address'];
                        }
                    }
                }

                foreach($flatsInRadius as $appartamento){  #flatsInRadius
                    foreach($indirizzi as $indirizzo){
                        if($appartamento['address_id'] == $indirizzo['id']){
                            $appartamento['description'] = $indirizzo['address'];
                        }
                    }
                }


                if(empty($appartamentiFiltrati)){ // se è vuoto appartamenti filtrati
                    /* $risultato = 'nessun risultato, con i filtri di ricerca';
                    $appartamentiFiltrati =  $risultato; */                
                    return $flatsInRadius;
                }

                return $appartamentiFiltrati;

                /*  $objfilter = [ 
                        'appartamentiRicercati' => $flatsInRadius,
                        'appartamentiFiltrati' => $appartamentiFiltrati,
                    ];
                
                    return $objfilter; */
          
            } //chiusura if($lat != '' && $lng != ''
        } // chiusura  if($request->ajax())


        $lat = $_GET['query_lat'];
        $lng = $_GET['query_lng'];
        $city = $_GET['city'];

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
    function show(Flat $flat, View $view, Request $request){
        $service = $flat->services;

        // ad ogni visualizzazione della pagina flat genero un record della tabella views e gli assegno il flat_id
        $view['flat_id'] = $flat['id'];
        $view->save();

        if($request->ajax()){
            $data= $_GET['geo'];

            $lat= $data[0];
            $lng= $data[1];
            $city= $data[2];

            return view('flat',compact('lat', 'lng', 'city'));

        }

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
