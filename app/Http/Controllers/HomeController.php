<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Flat;
use App\Payment;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    //    $this->middleware('auth'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $momentoAttuale = Carbon::now();; // ATTENZIONE sistemare ora legale  memorizzo in una var data e ora attuale, nello stesso formato del created_at 
        // $momentoAttuale = date("Y-m-d H:i:s"); // ATTENZIONE sistemare ora legale  memorizzo in una var data e ora attuale, nello stesso formato del created_at 
        $sponsAttive = Payment::all()->where('end_rate', '>', $momentoAttuale); // memorizzo in una var tutti i pagamenti con end_rate successivo al momento attuale (vuol dire che sono sponsorizzati)
        $flatsIdSpons = [];                                                     // imposto un array vuoto
        foreach($sponsAttive as $sponsAttiva){
            array_push($flatsIdSpons, $sponsAttiva->flat_id);                   // memorizzo nell'array vuoto tutti gli id degli appartamenti sponsorizzati
        }
        $flatsSpons = Flat::all()->whereIn('id', $flatsIdSpons);                // memorizzo in una var tutti gli appartamenti con id contenuto nell'array degli id degli appartamenti sponsorizzati
        return view('home', compact('flatsSpons'));
    }
}
