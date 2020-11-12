<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Flat;

class FlatController extends Controller
{
    function index(){
        $flats = Flat::all()->where('user_id', Auth::id());
        return view('admin.flats', compact('flats'));
    }

    function store(){
        return view('', compact());
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

    public function destroy(Flat $flats)
    {
        $flats->delete();
        return redirect()->route('login');
    }
}
