<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Flat;
use App\Payment;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flats = Flat::all()->where('user_id', Auth::id());
        return view('admin.payments.create', compact('flats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Payment $payment)
    {
        $data = $request->all();

        $request->validate([
            'flat_id' => 'required',
            'rate_id' => 'required'
        ]);
        
        $momentoAttuale = Carbon::now()->setTimezone('Europe/Rome');
        if($data['rate_id'] == 1){
            $data['end_rate'] = $momentoAttuale->addHours(24);
        } elseif($data['rate_id'] == 2){
            $data['end_rate'] = $momentoAttuale->addHours(72);
        } elseif($data['rate_id'] == 3){
            $data['end_rate'] = $momentoAttuale->addHours(144);
        };

        $payment['flat_id'] = $data['flat_id'];
        $payment['rate_id'] = $data['rate_id'];
        $payment->fill($data);

        $payment->save();

        $salvato = $payment->save();
        if($salvato){
            return redirect()->route('admin.flats.index')->with('status', 'L\'appartamento ' . $payment->flat_id . ' è sponsorizzato');
        };
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
