<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

    // aggiunga 12-11 controllo stato autenticazione
    /* public function __construct()
    {
        $this->middleware('auth');
    } */


    function index(){
        $user = User::find(Auth::id());
        return view('admin/users/profile',compact('user'));
    }

    public function store(Request $request)
    {
        
    }

    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $request->validate([ #validazione e controllo dei dati passati
            'date_of_birth' => 'required',
            'avatar' => 'image',
        ]);

        $user->update($data);

        return redirect('admin/users')->with('status', 'Profilo aggiornato');#->json(['code'=> 200, 'message' => 'Profilo aggiornato con successo','data' => $user], 200);
    }

    public function show($id)
    {
        
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
