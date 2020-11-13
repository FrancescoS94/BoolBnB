<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Flat;
use App\Payment;

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
        $momentoAttuale = date("Y-m-d H:i:s");  // sistemare ora legale
        $sponsAttive = Payment::all()->where('end_rate', '>', $momentoAttuale);
        $flatsIdSpons = [];
        foreach($sponsAttive as $sponsAttiva){
            array_push($flatsIdSpons, $sponsAttiva->flat_id);
        }
        // dd($flatsIdSpons);
        
        $flatsSpons = Flat::all()->whereIn('id', $flatsIdSpons);
        // dd($flatsSpons);

        return view('home', compact('flatsSpons'));
    }
}
