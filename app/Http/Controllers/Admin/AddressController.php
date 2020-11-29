<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use App\Flat;
use App\Service;

class AddressController extends Controller
{
    public function create(){
        return view('admin.addresses.create');
    }

    public function store(Request $request, Address $address, Service $service){

        $data = $request->all();

        /* $request->validate([
            'address' => 'required|string',
            'position' => 'required|string',
        ]); */

        

        //dd($data);

       #riempio i vari campi dopo la validazione */
        $address->fill($data);
        $address->save();

        if($address->save()){
            $service = Service::all();
            return view('admin.flats.flats-create', compact('address', 'service')); //->with('status', 'Hai aggiunto correttamente l\'indirizzo del nuovo appartamento');
        }else{
            abort(404);
        }
    }


    public function update(Request $request, Address $address, Flat $flats){

        // $data = $request->all();
        // dd($data);
        // /* $request->validate([
        //     'country' => 'required|string',
        //     'city' => 'required|string',
        //     'address' => 'required|string',
        //     'cap' => 'required|numeric',
        //     'district' => 'required|string'
        // ]); */
        // $request->validate([
        //     'address' => 'required|string',
        //     'lat' => 'required',
        //     'lng' => 'required',
        // ]);

        if($request->ajax()){
            $data->address = $_GET['address'];
            $data->lat = $_GET['lat'];
            $data->lng = $_GET['lng'];
            $address->update($data);
            
            // if($address->update($data)){
            //     return redirect()->route('admin.flats.index')->with('status','Complimenti hai modificato correttamente le informazione del tuo appartamento');
            // }else{
            //     abort(404);
            // }
        }
        
        
        // $address->update($data);

        
        // if($address->update($data)){
            //     return redirect()->route('admin.flats.index')->with('status','Complimenti hai modificato correttamente le informazione del tuo appartamento');
        // }else{
        //     abort(404);
        // }
    }

    public function edit(Flat $flat, Address $address){
        return view('admin.addresses.update', compact('flat', 'address'));
    }

}
