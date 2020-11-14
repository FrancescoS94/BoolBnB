<?php

namespace App\Http\Controllers;

use App\Flat;
use Illuminate\Http\Request;
use App\Payment;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tutti gli appartamenti, per risultato di ricerca
        $flats = Flat::all();
        
        // filtro per appartamenti sponsorizzati
        $momentoAttuale = date("Y-m-d H:i:s"); // ATTENZIONE sistemare ora legale  memorizzo in una var data e ora attuale, nello stesso formato del created_at 
        $sponsAttive = Payment::all()->where('end_rate', '>', $momentoAttuale); // memorizzo in una var tutti i pagamenti con end_rate successivo al momento attuale (vuol dire che sono sponsorizzati)
        $flatsIdSpons = [];                                                     // imposto un array vuoto
        foreach($sponsAttive as $sponsAttiva){
            array_push($flatsIdSpons, $sponsAttiva->flat_id);                   // memorizzo nell'array vuoto tutti gli id degli appartamenti sponsorizzati
        }
        $flatsSpons = Flat::all()->whereIn('id', $flatsIdSpons);                // memorizzo in una var tutti gli appartamenti con id contenuto nell'array degli id degli appartamenti sponsorizzati
        
        // alla view ritorno entrambe le variabili
        return view('search',compact('flats', 'flatsSpons'));
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
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function show(Flat $flat)
    {
        return view('flat', compact('flat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function edit(Flat $flat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flat $flat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat)
    {
        //
    }
}
