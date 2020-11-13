<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Flat;
use App\Address;
use FFI;
use Illuminate\Support\Facades\Storage;

class FlatController extends Controller
{
    function index(){
        $flats = Flat::all()->where('user_id', Auth::id());
        return view('admin.flats.flats', compact('flats'));
    }

    function store(Request $request){

        $data = $request->all();
        $request->validate([ #validazione e controllo dei dati passati
            'title' => 'required|string|max:200|min:20',
            'room' => 'required|numeric|max:20|min:1',
            'bed' => 'required|numeric|max:20|min:1',
            'wc' => 'required|numeric|max:10|min:1',
            'mq' => 'required|numeric|max:1000|min:15',
            'description' => 'required|max:1200|min:15',
            'image' => 'image|required'
        ]);


        $newFlat= new Flat();
        $newFlat['address_id'] = $data['address'];
        $newFlat['user_id'] = Auth::id(); #id dell'utente loggato

        if(!empty($data['image'])){
            $data['image'] = Storage::disk('public')->put('images', $data['image']);
        }

        $newFlat->fill($data); #rimepio i vari campi dopo la validazione
        $newFlat->save();

        if($newFlat->save()){
            return redirect()->route('admin.flats.index')->with('status', 'Hai aggiunto correttamente un nuovo appartamento');
        }else{
            abort(404);
        }
    }

    function update(Request $request, Flat $flat){

        $data = $request->all();
        $request->validate([ #validazione e controllo dei dati passati
            'title' => 'required|string|max:200|min:60',
            'room' => 'required|numeric|max:20|min:1',
            'bed' => 'required|numeric|max:20|min:1',
            'wc' => 'required|numeric|max:10|min:1',
            'mq' => 'required|numeric|max:1000|min:15',
            'description' => 'required|max:1200|min:15',
            'image' => 'image|required'
        ]);

         

        //controllo sulle immagini
        if(!empty($data['image'])){
            if(!empty($flat->image)){
                Storage::disk('public')->delete($flat->image);
            }
            $data['image'] = Storage::disk('public')->put('images', $data['image']);
        }

        $flat->update($data);

        if($flat->update($data)){
            return redirect()->route('admin.flats.index')->with('status', 'Hai modificato corretamente il tuo profilo');
        }else{
            abort(404);
        }
        /* return redirect()->route('admin.flats.index'); */
    }

    function show(Flat $flat){
        return view('admin.flats.flats-show',compact('flat'));
    }

    public function destroy(Flat $flat)
    {
        $flat->delete();
        return redirect()->route('admin.flats.index');
    }


    public function create(){
        return view('admin.flats.flats-create', compact('address'));
    }

    public function edit(Flat $flat){
        return view('admin.flats.flats-update', compact('flat'));
    }
}
