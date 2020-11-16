<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index(){
        $user = User::find(Auth::id());
        return view('admin/users/profile',compact('user'));
    }

    public function store(Request $request)
    {
        
    }

    public function update(Request $request, User $user)
    {
        if(is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth)){
            $data= $request->only(['avatar', 'date_of_birth']);
            $request->validate([
                'date_of_birth' => 'required',
                'avatar' => 'image|required'
            ]);

        }else{

            $data = $request->all(); 
            $request->validate([ #validazione e controllo dei dati passati
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                /* 'email' => 'required|string|email|max:255', unique:users */
                'password' => 'required|string|min:8|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'required|string|min:8',
                'date_of_birth' => 'required',
                'avatar' => 'image|required',
            ]);

            $user['password'] = Hash::make($request['password']);
        }

        //controllo sulle immagini
        if(!empty($data['avatar'])){
            if(!empty($user->avatar)){
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = Storage::disk('public')->put('images', $data['avatar']);
        }

        $user->update($data);

        if($user->update($data)){
            /* return redirect()->route('admin.users.profile')->with('status', 'Profilo aggiornato'); */
            return view('admin.users.profile',compact('user'))->with('status', 'Profilo aggiornato');
        }else{
            abort(404);
        }
    }

    public function show($id)
    {
        
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.profile-update', compact('user'));
    }
}
