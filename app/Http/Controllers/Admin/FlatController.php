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
            'title' => 'required|string|max:200|min:60',
            'room' => 'required|numeric|max:20|min:1',
            'bed' => 'required|numeric|max:20|min:1',
            'wc' => 'required|numeric|max:10|min:1',
            'mq' => 'required|numeric|max:1000|min:15',
            'description' => 'required|max:1200|min:150',
            'image' => 'image|required'
        ]);


        $newFlat= new Flat();
        $newFlat['user_id'] = Auth::id(); #id dell'utente loggato

        if(!empty($data['image'])){
            $data['image'] = Storage::disk('public')->put('images', $data['image']);
        }

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
            'title' => 'required|string|max:200|min:60',
            'room' => 'required|numeric|max:20|min:1',
            'bed' => 'required|numeric|max:20|min:1',
            'wc' => 'required|numeric|max:10|min:1',
            'mq' => 'required|numeric|max:1000|min:15',
            'description' => 'required|max:1200|min:150',
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
