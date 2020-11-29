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
    public function create()
    {
        // stampo gli appartamenti sponsorizzabili
        $flats = Flat::all()->where('user_id', Auth::id());

        // credenziali braintree
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 't88vvm9qkqhd69dx',
            'publicKey' => '75g7jjmpm723p9q5',
            'privateKey' => 'da50cb052035c68c347219f1ce616b1f'
        ]);
        // generazione token braintree
        $token = $gateway->ClientToken()->generate();

        return view('admin.payments.create', compact('flats','token', 'gateway'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request, Payment $payment)
    {
        // credenziali braintree
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 't88vvm9qkqhd69dx',
            'publicKey' => '75g7jjmpm723p9q5',
            'privateKey' => 'da50cb052035c68c347219f1ce616b1f'
        ]);

        $request->validate([
            'flat_id' => 'required',
            'rate_id' => 'required'
        ]);

        if($request['rate_id'] == 1){
            $amount = 2.99;
        } elseif($request['rate_id'] == 2){
            $amount = 5.99;
        } elseif($request['rate_id'] == 3){
            $amount = 9.99;
        };

        $nonce = $request->payment_method_nonce;
        
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;

            $momentoAttuale = Carbon::now()->setTimezone('Europe/Rome');
            
            if($request['rate_id'] == 1){
                $request['end_rate'] = $momentoAttuale->addHours(24);
            } elseif($request['rate_id'] == 2){
                $request['end_rate'] = $momentoAttuale->addHours(72);
            } elseif($request['rate_id'] == 3){
                $request['end_rate'] = $momentoAttuale->addHours(144);
            };

            $payment['flat_id'] = $request['flat_id'];
            $payment['rate_id'] = $request['rate_id'];
            $payment['end_rate'] = $request['end_rate'];

            $payment->save();

            $salvato = $payment->save();
            if($salvato){
                return redirect()->route('admin.flats.index')->with('status', 'L\'appartamento ' . $payment->flat->title . ' è sponsorizzato');
            };

        } else {
            $errorString = "";
            
            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            
            return back()->withErrors('Si è verificato un errore con il messaggio: ' . $result->message);
        }
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
