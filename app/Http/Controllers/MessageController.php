<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\Flat;
use Carbon\Carbon;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // non serve, il guest non vedrà mai tutti i messaggi inviati
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // non serve, il form per creare messaggio è nella pagina flat (FlatController)
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Message $message){
        $data = $request->all();

        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email'=> 'email',
            'request'=> 'required'
        ]);
        
        $message['flat_id'] = $data['flat'];
        $message['created_at'] = Carbon::now()->setTimezone('Europe/Rome');            // memorizzo in una var data e ora attuale, nello stesso formato del created_at
        $message['updated_at'] = Carbon::now()->setTimezone('Europe/Rome');            // memorizzo in una var data e ora attuale, nello stesso formato del created_at

        $message->fill($data);
        $salvato = $message->save();
        
        // individuo l'appartamento per cui è stato mandato il messaggio
        $flat = Flat::all()->find($message->flat_id);

        if($salvato){
            // torno nella show dell'appartamento per cui è stato mandato il messaggio
            return redirect()->route('flats.show', compact('flat'))->with('status', 'Messaggio inviato correttamente');
        };
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        // non serve, lo show del messaggio è nella parte admin
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        // non serve, il messaggio non sarà mai modificabile
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        // non serve, il messaggio non sarà mai modificabile per il guest 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        // non serve, il guest non potrà mai cancellare un messaggio
    }
}
