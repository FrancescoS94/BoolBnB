<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Flat;
use App\Payment;
use Carbon\Carbon;
use \Braintree\Gateway;


class PaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allFlats = Flat::all(); // memorizzo tutti gli appartamenti dell'utente loggato
        $flatsId = [];                                  // creo un array vuoto
        for($i = 0; $i < count($allFlats); $i++){       // per ogni appartamento
            if($allFlats[$i]['user_id'] == Auth::id()){ // SE lo user_id di quell'appartamento è uguale allo user_id dell'utente loggato
                $flatsId[] = $allFlats[$i]['id'];       // inserisco questo id nell'array vuoto
            }
        }
        // dd($flatsId);

        $payments = Payment::all()->whereIn('flat_id', $flatsId);   // memorizzo in payments soltanto con i pagamenti in cui il flat_id è contenuto nell'array in cui ho memorizzato gli id degli appartamenti dell'utente loggato

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

       // $gateway = new \Braintree\Gateway([
       //      'environment' => config('sandbox'),
       //      'merchantId' => config('29n4fm338ryhzsn2'),
       //      'publicKey' => config('m8tty4tbwv25cwbw'),
       //      'privateKey' => config('ac89525f6078c48a79788964b45da2fa')
       //  ]);

        // $token = $gateway->ClientToken()->generate();

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
