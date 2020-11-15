<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use App\Flat;

class AddressController extends Controller
{
    public function create(){
        return view('admin.addresses.create');
    }

    public function store(Request $request, Address $address){

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
        }else{
            abort(404);
        }
    }


    public function update(Request $request, Address $address, Flat $flats){

        $data= $request->all();
        $request->validate([
            'country' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'cap' => 'required|numeric',
            'district' => 'required|string'
        ]);

        $address->update($data);

        if($address->update($data)){
            return redirect()->route('admin.flats.index')->with('status','Complimenti hai modificato correttamente le informazione del tuo appartamento');
        }else{
            abort(404);
        }
    }

    public function edit(Flat $flat, Address $address){
        return view('admin.addresses.update', compact('flat', 'address'));
        // qui passo l'id dell'appartamento 
    }

}
