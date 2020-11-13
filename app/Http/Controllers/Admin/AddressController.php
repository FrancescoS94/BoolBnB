<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller
{
    function store(Request $request, Address $address){

        $data = $request->all();

        // $request->validate([ #validazione e controllo dei dati passati
        //     'title' => 'required|string|max:200|min:20',
        //     'room' => 'required|numeric|max:20|min:1',
        //     'bed' => 'required|numeric|max:20|min:1',
        //     'wc' => 'required|numeric|max:10|min:1',
        //     'mq' => 'required|numeric|max:1000|min:15',
        //     'description' => 'required|max:1200|min:15',
        //     'image' => 'image|required'
        // ]);

        $address->fill($data); #riempio i vari campi dopo la validazione
        $address->save();

        if($address->save()){
            return redirect()->route('admin.flats.create', compact('address'))->with('status', 'Hai aggiunto correttamente l\'indirizzo del nuovo appartamento');
        }else{
            abort(404);
        }
    }
}
