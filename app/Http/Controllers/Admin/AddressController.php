<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller
{
    public function create(){
        return view('admin.addresses.create');
    }

    function store(Request $request, Address $address){

        $data = $request->all();

        $request->validate([ #validazione e controllo dei dati passati
            'country' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'cap' => 'required|numeric',
            'district' => 'required|string'
        ]);

        $address->fill($data); #riempio i vari campi dopo la validazione
        $address->save();

        if($address->save()){
            return view('admin.flats.flats-create', compact('address'))->with('status', 'Hai aggiunto correttamente l\'indirizzo del nuovo appartamento');
            // return redirect()->route('admin.flats.create', compact('address'))->with('status', 'Hai aggiunto correttamente l\'indirizzo del nuovo appartamento');
        }else{
            abort(404);
        }
    }
}
