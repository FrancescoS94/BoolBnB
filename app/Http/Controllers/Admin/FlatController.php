<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Flat;
use App\Address;
use FFI;

class FlatController extends Controller
{
    function index(){
        $flats = Flat::all()->where('user_id', Auth::id());
        #dd($flats);
        return view('admin.flats.flats', compact('flats'));
    }

    function store(Request $request){

        $data = $request->all();
        $request->validate([ #validazione e controllo dei dati passati
            'room' => 'required',
            'bed' => 'required',
            'wc' => 'required',
            'mq' => 'required',
            'description' => 'required|max:300',
            'image' => 'image'
        ]);


        $newFlat= new Flat();
        $newFlat['user_id'] = Auth::id(); #id dell'utente loggato

        $newFlat->fill($data); #rimepio i vari campi dopo la validazione
        $newFlat->save();

        if($newFlat->save()){
            return redirect()->route('admin.flats.index');
        }else{
            abort(404);
        }
    }

    function update(Request $request, Flat $flat){

        $data = $request->all();
        $request->validate([ #validazione e controllo dei dati passati
            'room' => 'required',
            'bed' => 'required',
            'wc' => 'required',
            'mq' => 'required',
            'description' => 'required|max:300',
            'image' => 'image',
        ]);

        $flat->update($data);

        return redirect()->route('admin.flats.index');
    }

    function show(){
        
    }

    public function destroy(Flat $flat)
    {
        $flat->delete();
        return redirect()->route('admin.flats.index');
    }
}
