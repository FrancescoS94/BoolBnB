<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Message;
use App\Flat;

class MessageController extends Controller
{
    // 12-11 struttura superflua
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check()){
            $allFlats = Flat::all();                            // stampo tutti gli appartamenti in una variabile
            $flatsId = [];                                      // creo un array vuoto
            $countFlats = count($allFlats);                     // conto quanti sono gli appartamenti
            for($i = 0; $i < $countFlats; $i++){                // per ogni appartamento
                if($allFlats[$i]['user_id'] == Auth::id()){     // SE lo user_id di quell'appartamento è uguale allo user_id dell'utente loggato
                    $flatsId[] = $allFlats[$i]['id'];           // inserisco questo id nell'array vuoto
                }
            }
            
            $messages = Message::all();                         // stampo tutti i messaggi
            $messagesReceived = [];                             // creo un array vuoto dove andrò a inserire tutti i messaggi ricevuti dall'utente loggato        
            $countFlatsId = count($flatsId);                    // conto quanti sono gli appartamenti dell'utente loggato
            
            for($i=0; $i < $countFlatsId; $i++){                // ciclo gli appartamenti dell'utente loggato
                foreach($messages as $message){                 // ciclo tutti i messaggi
                    if($message->flat_id == $flatsId[$i]){      // SE il messaggio è stato inviato per un appartamento dell'utente loggato
                        array_push($messagesReceived, $message);// inserisco l'oggetto messaggio nell'array vuoto
                    }
                }
            }

            return view('admin.messages.index', compact('messagesReceived'));
        }
    }

    public function show(Message $message){
        return view('admin.messages.show', compact('message'));
    }
    
    public function create(){
        // non serve, il form per creare messaggio è nella pagina flat (FlatController fz show) [non c'entra admin]
    }
    
    public function store(Request $request, Message $message){
        // non serve, il form per creare messaggio è nella pagina flat (FlatController fz show) [non c'entra admin]
    }
    
    public function destroy(Message $message){
        $message->delete();
        return redirect()->route('admin.messages.index')->with('status','Messaggio cancellato correttamente');
    }
    
    public function edit(Post $post){
        // non serve, il messaggio non sarà modificabile
    }
    
    public function update(Message $message){

        $message['viewed'] = !$message['viewed'];

        $message->update();
        
        return redirect()->route('admin.messages.index');
    }
}
